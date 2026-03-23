<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IngredientResource\Pages;
use App\Models\Ingredient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IngredientResource extends Resource
{
    protected static ?string $model = Ingredient::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Nguyên liệu';
    protected static ?string $modelLabel = 'Nguyên liệu';
    protected static ?string $pluralModelLabel = 'Nguyên liệu';
    protected static ?string $navigationGroup = 'Phân loại';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Tên nguyên liệu')->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')->label('Slug')->required()->maxLength(255),
            Forms\Components\TextInput::make('group_name')->label('Nhóm nguyên liệu')->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Tên')->searchable(),
            Tables\Columns\TextColumn::make('group_name')->label('Nhóm')->searchable(),
            Tables\Columns\TextColumn::make('slug')->label('Slug')->toggleable(),
            Tables\Columns\TextColumn::make('recipes_count')->label('Số công thức')->counts('recipes'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIngredients::route('/'),
            'create' => Pages\CreateIngredient::route('/create'),
            'edit' => Pages\EditIngredient::route('/{record}/edit'),
        ];
    }
}