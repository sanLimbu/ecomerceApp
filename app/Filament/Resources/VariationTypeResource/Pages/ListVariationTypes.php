<?php

namespace App\Filament\Resources\VariationTypeResource\Pages;

use App\Filament\Resources\VariationTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVariationTypes extends ListRecords
{
    protected static string $resource = VariationTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
