<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VariationTypeResource\Pages;
use App\Filament\Resources\VariationTypeResource\RelationManagers;
use App\Models\VariationType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class VariationTypeResource extends Resource
{
    protected static ?string $model = VariationType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Variation';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVariationTypes::route('/'),
            'create' => Pages\CreateVariationType::route('/create'),
            'edit' => Pages\EditVariationType::route('/{record}/edit'),
        ];
    }    
}
