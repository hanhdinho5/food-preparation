<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Models\Blog;
use App\Models\DishType;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    $topRecipes = Recipe::with(['ratings', 'region', 'dishType'])
        ->when(Schema::hasColumn('recipes', 'status'), fn($query) => $query->where('status', 'published'))
        ->select('recipes.*')
        ->withAvg('ratings', 'score')
        ->orderByDesc('ratings_avg_score')
        ->limit(4)
        ->get();

    return view('welcome', [
        'recipe' => $topRecipes,
        'totalUsers' => User::count(),
        'totalRecipes' => Recipe::count(),
        'totalBlogs' => Schema::hasTable('blogs') ? Blog::published()->count() : 0,
    ]);
})
    ->middleware(['guest']);

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/dashboard', function (Request $request) {
    $selectedAvailableIngredients = collect($request->input('available_ingredients', []))
        ->filter()
        ->map(fn($id) => (int) $id)
        ->values()
        ->all();

    $recipe = Recipe::with(['user', 'region', 'dishType', 'ingredientsList'])
        ->when($request->filled('search'), function ($query) use ($request) {
            $searchTerm = trim($request->search);
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('summary', 'like', '%' . $searchTerm . '%')
                    ->orWhere('category', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', fn($userQuery) => $userQuery->where('name', 'like', '%' . $searchTerm . '%'))
                    ->orWhereHas('region', fn($regionQuery) => $regionQuery->where('name', 'like', '%' . $searchTerm . '%'))
                    ->orWhereHas('dishType', fn($dishTypeQuery) => $dishTypeQuery->where('name', 'like', '%' . $searchTerm . '%'))
                    ->orWhereHas('ingredientsList', fn($ingredientQuery) => $ingredientQuery->where('name', 'like', '%' . $searchTerm . '%'));
            });
        })
        ->when($request->filled('region'), fn($query) => $query->where('region_id', $request->integer('region')))
        ->when($request->filled('dish_type'), fn($query) => $query->where('dish_type_id', $request->integer('dish_type')))
        ->when($request->filled('ingredient'), fn($query) => $query->whereHas('ingredientsList', fn($ingredientQuery) => $ingredientQuery->where('ingredients.id', $request->integer('ingredient'))))
        ->when(count($selectedAvailableIngredients) > 0, function ($query) use ($selectedAvailableIngredients) {
            $query->whereHas('ingredientsList', fn($ingredientQuery) => $ingredientQuery->whereIn('ingredients.id', $selectedAvailableIngredients))
                ->withCount(['ingredientsList as matched_ingredients_count' => fn($ingredientQuery) => $ingredientQuery->whereIn('ingredients.id', $selectedAvailableIngredients)])
                ->orderByDesc('matched_ingredients_count');
        })
        ->when($request->filled('difficulty'), fn($query) => $query->where('difficulty', $request->difficulty))
        ->when($request->filled('sort'), function ($query) use ($request) {
            match ($request->sort) {
                'rating' => $query->withAvg('ratings', 'score')->orderByDesc('ratings_avg_score'),
                'popular' => $query->withCount('favorites')->orderByDesc('favorites_count'),
                'time_asc' => $query->orderBy('cooking_time'),
                default => $query->latest(),
            };
        }, fn($query) => $query->latest())
        ->paginate(6)
        ->withQueryString();

    return view('dashboard', [
        'recipe' => $recipe,
        'regions' => Region::orderBy('name')->get(),
        'dishTypes' => DishType::orderBy('name')->get(),
        'ingredientsCatalog' => Ingredient::orderBy('name')->get(),
        'difficultyOptions' => ['Dễ', 'Trung bình', 'Khó'],
        'selectedAvailableIngredients' => $selectedAvailableIngredients,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('recipe', RecipeController::class);
    Route::resource('favorite', FavoriteController::class);
    Route::get('comment', [CommentController::class, 'index'])->name('comment.index');

    Route::get('my-blogs', [BlogController::class, 'myIndex'])->name('my-blogs.index');
    Route::get('my-blogs/create', [BlogController::class, 'create'])->name('my-blogs.create');
    Route::post('my-blogs', [BlogController::class, 'store'])->name('my-blogs.store');
    Route::delete('my-blogs/{blog}', [BlogController::class, 'destroy'])->name('my-blogs.destroy');

    Route::post('recipe/rating', [RecipeController::class, 'saveRating'])->name('recipe.rating');
    Route::post('recipe/comment', [RecipeController::class, 'sendComment'])->name('recipe.comment');
});

require __DIR__ . '/auth.php';
