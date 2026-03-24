<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Người dùng';
    protected static ?string $modelLabel = 'người dùng';
    protected static ?string $pluralModelLabel = 'người dùng';
    protected static ?string $navigationGroup = 'Quản lý hệ thống';

    public static function form(Form $form): Form
    {
        $isCreate = $form->getOperation() === 'create';
        $isEdit = $form->getOperation() === 'edit';

        return $form->schema([
            Forms\Components\FileUpload::make('avatar')
                ->label('Ảnh đại diện')
                ->disk('public')
                ->directory('avatars')
                ->image()
                ->imageEditor()
                ->avatar()
                ->maxSize(2048)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('name')
                ->label('Họ và tên')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),
            Forms\Components\DateTimePicker::make('email_verified_at')
                ->label('Thời điểm xác thực email'),
            Forms\Components\TextInput::make('password')
                ->label('Mật khẩu')
                ->password()
                ->revealable()
                ->minLength(8)
                ->maxLength(255)
                ->hidden(! ($isCreate || $isEdit))
                ->required($isCreate)
                ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->helperText($isEdit ? 'Để trống nếu bạn muốn giữ nguyên mật khẩu hiện tại.' : null),
            Forms\Components\Select::make('role')
                ->label('Vai trò')
                ->options([
                    'admin' => 'Quản trị viên',
                    'user' => 'Người dùng',
                ])
                ->required()
                ->default('user')
                ->native(false),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query->withCount('recipes'))
            ->columns([
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Ảnh đại diện')
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(asset('images/avatar-placeholder.svg')),
                Tables\Columns\TextColumn::make('name')
                    ->label('Họ và tên')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable(),
                Tables\Columns\TextColumn::make('recipes_count')
                    ->label('Tổng công thức')
                    ->icon('heroicon-m-book-open')
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Vai trò')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'admin' ? 'Quản trị viên' : 'Người dùng')
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ngày cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            Infolists\Components\Section::make('Thông tin tài khoản')
                ->schema([
                    Infolists\Components\ImageEntry::make('avatar')
                        ->label('Ảnh đại diện')
                        ->disk('public')
                        ->defaultImageUrl(asset('images/avatar-placeholder.svg'))
                        ->circular(),
                    Infolists\Components\TextEntry::make('name')
                        ->label('Họ và tên'),
                    Infolists\Components\TextEntry::make('email')
                        ->label('Email'),
                    Infolists\Components\TextEntry::make('role')
                        ->label('Vai trò')
                        ->badge()
                        ->formatStateUsing(fn (string $state): string => $state === 'admin' ? 'Quản trị viên' : 'Người dùng'),
                    Infolists\Components\TextEntry::make('recipes_count')
                        ->label('Tổng công thức')
                        ->state(fn (User $record): int => $record->recipes()->count()),
                    Infolists\Components\TextEntry::make('email_verified_at')
                        ->label('Xác thực email')
                        ->dateTime('d/m/Y H:i')
                        ->placeholder('Chưa xác thực'),
                    Infolists\Components\TextEntry::make('created_at')
                        ->label('Ngày tạo')
                        ->dateTime('d/m/Y H:i'),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label('Ngày cập nhật')
                        ->dateTime('d/m/Y H:i'),
                ])
                ->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}