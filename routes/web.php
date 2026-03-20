<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $topRecipes = Recipe::with('ratings') // Eager load the ratings relationship
        ->select('recipes.*') // Select all fields from the recipes table
        ->withAvg('ratings', 'score') // Calculate the average rating
        ->orderBy('ratings_avg_score', 'DESC') // Order by the average rating
        ->limit(3) // Limit to 3 results
        ->get();
    // dd($topRecipes);

    $totalRecipes = Recipe::count();

    $totalUsers = User::count();

    return view('welcome', [
        'recipe' => $topRecipes,
        'totalUsers' => $totalUsers,
        'totalRecipes' => $totalRecipes
    ]);
})->middleware(['guest']);

Route::get('/dashboard', function (Request $request) {
    dd(1);
    $searchTerm = $request->search;

    if ($searchTerm) {
        $recipe = Recipe::whereHas('user', function ($query) use ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        })->orWhere('category', 'like', '%' . $searchTerm . '%')
            ->orWhere('title', 'like', '%' . $searchTerm . '%')
            ->paginate(3);
    } else {
        // number of items per page
        $recipe = Recipe::paginate(3);
    }

    return view('dashboard', ['recipe' => $recipe]);
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('recipe', RecipeController::class);
    Route::resource('favorite', FavoriteController::class);

    Route::post('recipe/rating', [RecipeController::class, 'saveRating'])->name('recipe.rating');

    Route::post('recipe/comment', [RecipeController::class, 'sendComment'])->name('recipe.comment');
});

require __DIR__ . '/auth.php';
