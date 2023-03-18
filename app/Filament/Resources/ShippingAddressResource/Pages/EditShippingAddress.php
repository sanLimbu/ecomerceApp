<?php

namespace App\Filament\Resources\ShippingAddressResource\Pages;

use App\Filament\Resources\ShippingAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingAddress extends EditRecord
{
    protected static string $resource = ShippingAddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
