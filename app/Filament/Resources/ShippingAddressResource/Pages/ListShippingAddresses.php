<?php

namespace App\Filament\Resources\ShippingAddressResource\Pages;

use App\Filament\Resources\ShippingAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippingAddresses extends ListRecords
{
    protected static string $resource = ShippingAddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
