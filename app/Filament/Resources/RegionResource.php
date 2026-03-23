<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegionResource\Pages;
use App\Models\Region;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'Vùng miền';
    protected static ?string $modelLabel = 'Vùng miền';
    protected static ?string $pluralModelLabel = 'Vùng miền';
    protected static ?string $navigationGroup = 'Phân loại';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Tên vùng miền')->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')->label('Slug')->required()->maxLength(255),
            Forms\Components\Textarea::make('description')->label('Mô tả')->rows(4)->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Tên')->searchable(),
            Tables\Columns\TextColumn::make('slug')->label('Slug')->searchable(),
            Tables\Columns\TextColumn::make('recipes_count')->label('Số công thức')->counts('recipes'),
            Tables\Columns\TextColumn::make('created_at')->label('Ngày tạo')->dateTime()->sortable(),
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
            'index' => Pages\ListRegions::route('/'),
            'create' => Pages\CreateRegion::route('/create'),
            'edit' => Pages\EditRegion::route('/{record}/edit'),
        ];
    }
}