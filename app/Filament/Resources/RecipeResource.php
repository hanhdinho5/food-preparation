<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\DishType;
use App\Models\Recipe;
use App\Models\Region;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Công thức';
    protected static ?string $modelLabel = 'Công thức';
    protected static ?string $pluralModelLabel = 'Công thức';
    protected static ?string $navigationGroup = 'Quản lý nội dung';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Tiêu đề')->required()->maxLength(255),
            Forms\Components\Textarea::make('summary')->label('Mô tả ngắn')->rows(3)->columnSpanFull(),
            Forms\Components\Textarea::make('ingredients')->label('Chi tiết nguyên liệu')->required()->rows(5)->columnSpanFull(),
            Forms\Components\Textarea::make('instructions')->label('Hướng dẫn')->required()->rows(6)->columnSpanFull(),
            Forms\Components\Select::make('ingredient_ids')->label('Nguyên liệu chính')->multiple()->relationship('ingredientsList', 'name')->preload()->searchable(),
            Forms\Components\TextInput::make('prep_time')->label('Sơ chế (phút)')->numeric()->minValue(0),
            Forms\Components\TextInput::make('cooking_time')->label('Nấu (phút)')->required()->numeric()->minValue(1),
            Forms\Components\TextInput::make('servings')->label('Khẩu phần')->numeric()->minValue(1),
            Forms\Components\Select::make('difficulty')->label('Độ khó')->options([
                'Dễ' => 'Dễ',
                'Trung bình' => 'Trung bình',
                'Khó' => 'Khó',
            ]),
            Forms\Components\Select::make('category')->label('Phân loại bữa ăn')->options([
                'Bữa sáng' => 'Bữa sáng',
                'Bữa trưa' => 'Bữa trưa',
                'Bữa tối' => 'Bữa tối',
                'Ăn vặt' => 'Ăn vặt',
                'Món chính' => 'Món chính',
            ])->required(),
            Forms\Components\Select::make('region_id')->label('Vùng miền')->options(Region::query()->pluck('name', 'id'))->searchable(),
            Forms\Components\Select::make('dish_type_id')->label('Loại món')->options(DishType::query()->pluck('name', 'id'))->searchable(),
            Forms\Components\TextInput::make('video_url')->label('Liên kết video')->url(),
            Forms\Components\Select::make('status')->label('Trạng thái')->options([
                'published' => 'Đã xuất bản',
                'draft' => 'Bản nháp',
            ])->default('published')->required(),
            Forms\Components\FileUpload::make('image_path')->label('Hình ảnh')->disk('public')->directory('images')->image()->required(),
            Forms\Components\Select::make('user_id')->label('Tác giả')->options(User::all()->pluck('name', 'id'))->searchable()->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->label('Ảnh')->disk('public')->size(60),
                Tables\Columns\TextColumn::make('title')->label('Tiêu đề')->searchable(),
                Tables\Columns\TextColumn::make('region.name')->label('Vùng miền')->badge()->toggleable(),
                Tables\Columns\TextColumn::make('dishType.name')->label('Loại món')->badge()->toggleable(),
                // Tables\Columns\TextColumn::make('category')->label('Bữa ăn')->badge()->searchable(),
                Tables\Columns\TextColumn::make('ratings_avg_score')->label('Đánh giá')->avg('ratings', 'score')->icon('heroicon-m-star')->numeric(decimalPlaces: 1)->color('primary')->sortable(),
                Tables\Columns\TextColumn::make('cooking_time')->label('Thời gian nấu')->suffix(' phút')->sortable(),
                Tables\Columns\TextColumn::make('servings')->label('Khẩu phần')->toggleable(),
                Tables\Columns\TextColumn::make('status')->label('Trạng thái')->badge()->formatStateUsing(fn(string $state): string => $state === 'published' ? 'Đã xuất bản' : 'Bản nháp')->color(fn(string $state): string => $state === 'published' ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('user.name')->label('Tác giả')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Ngày tạo')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label('Ngày cập nhật')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('region_id')->label('Vùng miền')->options(Region::query()->pluck('name', 'id')),
                Tables\Filters\SelectFilter::make('dish_type_id')->label('Loại món')->options(DishType::query()->pluck('name', 'id')),
                Tables\Filters\SelectFilter::make('status')->label('Trạng thái')->options(['published' => 'Đã xuất bản', 'draft' => 'Bản nháp']),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Infolists\Components\Section::make('Thông tin công thức')->schema([
                Infolists\Components\ImageEntry::make('image_path')->disk('public')->height(180),
                Infolists\Components\TextEntry::make('title')->label('Tiêu đề'),
                Infolists\Components\TextEntry::make('summary')->label('Mô tả ngắn'),
                Infolists\Components\TextEntry::make('region.name')->label('Vùng miền')->placeholder('Chưa cập nhật'),
                Infolists\Components\TextEntry::make('dishType.name')->label('Loại món')->placeholder('Chưa cập nhật'),
                // Infolists\Components\TextEntry::make('category')->label('Phân loại bữa ăn'),
                Infolists\Components\TextEntry::make('difficulty')->label('Độ khó')->placeholder('Chưa cập nhật'),
                Infolists\Components\TextEntry::make('servings')->label('Khẩu phần')->placeholder('Chưa cập nhật'),
                Infolists\Components\TextEntry::make('prep_time')->label('Sơ chế')->suffix(' phút')->placeholder('Chưa cập nhật'),
                Infolists\Components\TextEntry::make('cooking_time')->label('Nấu')->suffix(' phút'),
                Infolists\Components\TextEntry::make('status')->label('Trạng thái'),
                Infolists\Components\TextEntry::make('video_url')->label('Video hướng dẫn')->url(fn($state) => $state)->openUrlInNewTab(),
                Infolists\Components\TextEntry::make('user.name')->label('Tác giả'),
                Infolists\Components\TextEntry::make('ratings')->label('Điểm trung bình')->formatStateUsing(fn($record) => number_format($record->ratings->avg('score') ?? 0, 1)),
            ])->columns(2),
            Infolists\Components\Section::make('Nguyên liệu chính')->schema([
                Infolists\Components\TextEntry::make('ingredientsList.name')->badge()->label('Danh sách'),
            ]),
            Infolists\Components\Section::make('Chi tiết nguyên liệu')->schema([
                Infolists\Components\TextEntry::make('ingredients')->label('Nội dung'),
            ]),
            Infolists\Components\Section::make('Hướng dẫn')->schema([
                Infolists\Components\TextEntry::make('instructions')->label('Các bước'),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
            'view' => Pages\ViewRecipe::route('/{record}'),
        ];
    }
}
