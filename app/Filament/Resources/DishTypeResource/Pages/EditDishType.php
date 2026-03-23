<?php

namespace App\Filament\Resources\DishTypeResource\Pages;

use App\Filament\Resources\DishTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDishType extends EditRecord
{
    protected static string $resource = DishTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}