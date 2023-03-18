<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Cart\Contracts\CartInterface;
use App\Models\ShippingType;
use App\Models\ShippingAddress;
use App\Models\Order;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;
class Checkout extends Component
{
    public $shippingTypeId;
    public $shippingTypes;
    protected $shippingAddress;
    public $userShippingAddressId;


    public $accountForm = [
        'email' => ''
    ];

    public  $shippingForm = [
          'first_name' => '',
          'last_name' => '',
          'address' => '',
          'house_number' => '',
          'city' => '',
          'country' => '',
          'post_code' => '',
          'phone' => ''
    ];

    protected $validationAttributes = [
        'accountForm.email' => 'email address',
        'shippingForm.first_name' => 'First Name',
        'shippingForm.last_name' => 'Last Name',
        'shippingForm.address' => 'Address',
        'shippingForm.house_number' => 'House Number',
        'shippingForm.city' => 'City',
        'shippingForm.country' => 'Country',
        'shippingForm.post_code' => 'Post Code',
        'shippingForm.phone' => 'Phone Number',
    ];

    protected $messages = [
        'accountForm.email.unique' => 'Seems you already have an account. Please sign in to place an order',
        'shippingForm.address.required' => 'Your :attribute is required'

    ];

    public function rules()
      {
        return [
            'accountForm.email' => 'required|email|max:255|unique:users,email' . (auth()->user() ? ',' . auth()->user()->id : ''),
            'shippingForm.first_name' => 'required|max:255',
            'shippingForm.last_name' => 'required|max:255',
            'shippingForm.address' => 'required|max:255',
            'shippingForm.house_number' => 'required|max:255',
            'shippingForm.city' => 'required|max:255',
            'shippingForm.country' => 'required|max:255',
            'shippingForm.post_code' => 'required|max:255',
            'shippingForm.phone' => 'required|max:255',
            'shippingTypeId' => 'required|exists:shipping_types,id'
        ];
      }

     public function updatedUserShippingAddressId($id)
      {
        if (!$id) {
            return;
        }

        $this->shippingForm = $this->userShippingAddresses->find($id)
                    ->only( 'first_name' ,
                    'last_name',
                    'address' ,
                    'house_number',
                    'city',
                    'country',
                    'post_code' ,
                    'phone' );

      } 

    public function getUserShippingAddressesProperty()
     {
        return auth()->user()?->shippingAddresses;
     }  

    public function checkout( CartInterface $cart )
     {
          $this->validate();

          if(!$this->getPaymentIntent($cart)->status == "succeeded")
            {
               $this->dispatchBrowserEvent('notification', [
                'body' => 'Your payment failed'
               ]);
               return;
            }
         
          $this->shippingAddress = ShippingAddress::query();

          if (auth()->user()) 
            {
                $this->shippingAddress = $this->shippingAddress->whereBelongsTo(auth()->user()); 
            }
             ( $this->shippingAddress = $this->shippingAddress->firstOrCreate($this->shippingForm))
                ?->user()
                ->associate(auth()->user())
                ->save();

          $order = Order::make(array_merge($this->accountForm, [
                'subtotal' => $cart->subtotal()
          ]));   
          
          $order->user()->associate(auth()->user());
          $order->shippingType()->associate($this->shippingType);
          $order->shippingAddress()->associate($this->shippingAddress);

          $order->save();

          $order->variations()->attach(
            $cart->contents()->mapWithKeys(function ($variation) {
                return  [
                    $variation->id => [
                        'quantity' => $variation->pivot->quantity
                      ]
                    ];
            })
            ->toArray()
          );

          $cart->contents()->each(function ($variation) {
            $variation->stocks()->create([
              'amount' => 0 - $variation->pivot->quantity
            ]);

          });

          $cart->removeAll();
          Mail::to($order->email)->send(new OrderCreated($order));
          $cart->destroy();
          
          if(!auth()->user()) 
           {
             return redirect()->route('orders.confirmation', $order);
           }
          
           return redirect()->route('orders');

     }

    public function mount()
    {
        $this->shippingTypes =  ShippingType::orderBy('price', 'asc')->get();
        $this->shippingTypeId =  $this->shippingTypes->first()->id;

        if ($user = auth()->user())
          {
            $this->accountForm['email'] = $user->email;
          }
    }


    public function getShippingTypeProperty()
    {
        return $this->shippingTypes->find($this->shippingTypeId);
    }

    public function getTotalProperty(CartInterface $cart)
     {
        return $cart->subtotal() + $this->shippingType->price;
     }

    public function getPaymentIntent(CartInterface $cart)
      {

      if ($cart->hasPaymentIntent()) 
         {
           $paymentIntent = app('stripe')->paymentIntents->retrieve($cart->getPaymentIntentId());
           
           if ($paymentIntent->status != "succeeded")
            {
              app('stripe')->paymentIntents->update($cart->getPaymentIntentId(), [
                'amount' => $this->total,
              ]);
            }

           return $paymentIntent;
         }

         $paymentIntent = app('stripe')->paymentIntents->create([
          'amount' => $this->total,
          'currency'=>'gbp',
          'setup_future_usage' => 'on_session',
          // 'metadata' => [
          //   'card_uuid'
          // ]
       ]);

       $cart->updatePaymentIntentId($paymentIntent->id);

        return $paymentIntent;
      }

    public function callValidate()
     {
      $this->validate();
     }  

    public function getErrorCount()
     {
       
      return $this->getErrorBag()->count();

     } 

    public function render(CartInterface $cart)
    { 
        return view('livewire.checkout', [
            'cart' => $cart,
            'shippingTypes' => $this->shippingTypes,
            'paymentIntent' => $this->getPaymentIntent($cart),
        ]);
    }
}
