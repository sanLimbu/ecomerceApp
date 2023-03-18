<?php

namespace App\Filament\Resources\ShippingTypeResource\Pages;

use App\Filament\Resources\ShippingTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShippingType extends EditRecord
{
    protected static string $resource = ShippingTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
