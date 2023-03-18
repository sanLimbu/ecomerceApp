<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Order;

class LatestOrders extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Order::query()->latest();
    }
 
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Customer'),
            Tables\Columns\TextColumn::make('shippingAddress.post_code'),
            Tables\Columns\TextColumn::make('shippingType.title'), 
            Tables\Columns\TextColumn::make('subtotal'),
            Tables\Columns\TextColumn::make('placed_at'),
            Tables\Columns\TextColumn::make('shipped_at'),     
        ];
    }
}
