<?php

namespace App\Filament\Resources\ShippingTypeResource\Pages;

use App\Filament\Resources\ShippingTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShippingTypes extends ListRecords
{
    protected static string $resource = ShippingTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
