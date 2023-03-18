<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShippingAddressResource\Pages;
use App\Filament\Resources\ShippingAddressResource\RelationManagers;
use App\Models\ShippingAddress;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class ShippingAddressResource extends Resource
{
    protected static ?string $model = ShippingAddress::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Shipping';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')->required(),
                Forms\Components\TextInput::make('last_name')->required(),
                Forms\Components\TextInput::make('address')->required(),
                Forms\Components\TextInput::make('house_number')->numeric(),
                Forms\Components\TextInput::make('city')->required(),
                Forms\Components\TextInput::make('country')->required(),
                Forms\Components\TextInput::make('post_code')->required(),
                Forms\Components\TextInput::make('phone')->numeric(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('first_name'),
                TextColumn::make('last_name'),
                TextColumn::make('post_code'),
                TextColumn::make('city'),
                TextColumn::make('phone'),
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
            'index' => Pages\ListShippingAddresses::route('/'),
            'create' => Pages\CreateShippingAddress::route('/create'),
            'edit' => Pages\EditShippingAddress::route('/{record}/edit'),
        ];
    }    
}
