<?php

namespace App\Filament\Widgets;

use App\Models\Recipe;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StateOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Tổng người dùng', $this->getTotalUsers())
                ->description('Tổng số người dùng đã tham gia hệ thống')
                ->descriptionIcon('heroicon-m-user')
                ->color('success'),
            Stat::make('Tổng công thức', $this->getTotalRecipes())
                ->description('Tổng số công thức đã được tạo')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('info'),
            Stat::make('Danh mục phổ biến', $this->getPopularCategory())
                ->description('Danh mục được người dùng tạo nhiều nhất')
                ->descriptionIcon('heroicon-m-tag')
                ->color('warning'),
        ];
    }

    public function getTotalUsers(): int
    {
        return User::where('role', 'user')->count() ?? 0;
    }

    public function getTotalRecipes(): int
    {
        return Recipe::count() ?? 0;
    }

    public function getPopularCategory(): string
    {
        return Recipe::select('category', DB::raw('COUNT(*) as total_recipes'))
            ->groupBy('category')
            ->orderBy('total_recipes', 'desc') // Change to 'asc' for ascending order
            ->first()
            ->category;
    }
}
