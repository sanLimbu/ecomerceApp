<?php

namespace App\Filament\Resources\VariationTypeResource\Pages;

use App\Filament\Resources\VariationTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVariationType extends EditRecord
{
    protected static string $resource = VariationTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
