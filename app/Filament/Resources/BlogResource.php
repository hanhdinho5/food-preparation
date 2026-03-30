<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Notifications\Notification;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Bài viết';
    protected static ?string $modelLabel = 'Bài viết';
    protected static ?string $pluralModelLabel = 'Bài viết';
    protected static ?string $navigationGroup = 'Quản lý nội dung';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Nội dung bài viết')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Tiêu đề')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('excerpt')
                        ->label('Mô tả ngắn')
                        ->rows(3)
                        ->maxLength(500)
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content')
                        ->label('Nội dung')
                        ->required()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'underline',
                            'strike',
                            'bulletList',
                            'orderedList',
                            'h2',
                            'h3',
                            'blockquote',
                            'link',
                            'undo',
                            'redo',
                        ])
                        ->columnSpanFull(),
                ])
                ->columns(2),
            Forms\Components\Section::make('Hiển thị')
                ->schema([
                    Forms\Components\FileUpload::make('thumbnail_path')
                        ->label('Ảnh đại diện')
                        ->disk('public')
                        ->directory('blog-thumbnails')
                        ->image(),
                    Forms\Components\Select::make('status')
                        ->label('Trạng thái')
                        ->options([
                            'unpublished' => 'Chưa xuất bản',
                            'published' => 'Đã xuất bản',
                        ])
                        ->default('unpublished')
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Thời gian xuất bản')
                        ->seconds(false)
                        ->helperText('Để trống thì sẽ tự lấy thời điểm hiện tại khi xuất bản.'),
                    Forms\Components\Select::make('from_user')
                        ->label('Tác giả')
                        ->options(User::query()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_path')
                    ->label('Ảnh')
                    ->disk('public')
                    ->defaultImageUrl(asset('assets/img/recipe_book.jpg'))
                    ->size(60),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Tác giả')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Trạng thái')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => $state === 'published' ? 'Đã xuất bản' : 'Chưa xuất bản')
                    ->color(fn(string $state): string => $state === 'published' ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Xuất bản')
                    ->since()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'unpublished' => 'Chưa xuất bản',
                        'published' => 'Đã xuất bản',
                    ]),
                Tables\Filters\SelectFilter::make('from_user')
                    ->label('Tác giả')
                    ->options(User::query()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\Action::make('publish')
                    ->label('Duyệt')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->hidden(fn(Blog $record): bool => $record->status === 'published')
                    ->action(function (Blog $record) {
                        $record->update([
                            'status' => 'published',
                            'published_at' => $record->published_at ?? now(),
                        ]);

                        Notification::make()
                            ->title('Bài viết đã được xuất bản thành công!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
