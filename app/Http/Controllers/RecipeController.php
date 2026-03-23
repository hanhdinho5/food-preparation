<?php

namespace App\Http\Controllers;

use App\Events\CommentMessage;
use App\Models\Comment;
use App\Models\DishType;
use App\Models\Ingredient;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    public function index()
    {
        $user = Auth::id();

        $recipe = Recipe::with(['region', 'dishType'])
            ->where('user_id', $user)
            ->latest()
            ->get();

        $totalBreakfast = Recipe::where('user_id', $user)->where('category', 'Bữa sáng')->count();
        $totalLunch = Recipe::where('user_id', $user)->where('category', 'Bữa trưa')->count();
        $totalDinner = Recipe::where('user_id', $user)->where('category', 'Bữa tối')->count();

        return view('recipes.index', compact('recipe', 'totalBreakfast', 'totalLunch', 'totalDinner'));
    }

    public function create()
    {
        return view('recipes.create', [
            'regions' => Region::orderBy('name')->get(),
            'dishTypes' => DishType::orderBy('name')->get(),
            'ingredientsCatalog' => Ingredient::orderBy('name')->get(),
            'categoryOptions' => $this->categoryOptions(),
            'difficultyOptions' => $this->difficultyOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->recipeRules(true));

        $imagePath = $request->file('image')->storeAs(
            'images',
            Str::slug($validated['title']) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension(),
            'public'
        );

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'summary' => $validated['summary'] ?? null,
            'ingredients' => $validated['ingredients'],
            'instructions' => $validated['instructions'],
            'cooking_time' => $validated['cooking_time'],
            'prep_time' => $validated['prep_time'] ?? null,
            'servings' => $validated['servings'] ?? null,
            'difficulty' => $validated['difficulty'] ?? null,
            'category' => $validated['category'],
            'image_path' => $imagePath,
            'video_url' => $validated['video_url'] ?? null,
            'status' => 'published',
            'user_id' => Auth::id(),
            'region_id' => $validated['region_id'] ?? null,
            'dish_type_id' => $validated['dish_type_id'] ?? null,
        ]);

        $recipe->ingredientsList()->sync($validated['ingredient_ids'] ?? []);

        return redirect()->route('recipe.index')->with('success', 'Công thức đã được lưu thành công!');
    }

    public function show(string $id)
    {
        $recipe = Recipe::with(['user', 'region', 'dishType', 'ingredientsList'])->findOrFail($id);
        $user = Auth::id();

        $isFavorited = $recipe->favorites()->where('user_id', $user)->exists();
        $ratingValue = Rating::where('recipe_id', $id)->avg('score');
        $ratingCount = Rating::where('recipe_id', $id)->count();
        $myRatingValue = Rating::where('recipe_id', $id)->where('from_user', $user)->avg('score');
        $comment = $recipe->comments()
            ->with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('recipes.view', compact('recipe', 'isFavorited', 'ratingValue', 'ratingCount', 'myRatingValue', 'comment'));
    }

    public function edit(string $id)
    {
        $recipe = Recipe::with('ingredientsList')->findOrFail($id);
        $this->authorizeRecipeOwner($recipe);

        return view('recipes.edit', [
            'recipe' => $recipe,
            'regions' => Region::orderBy('name')->get(),
            'dishTypes' => DishType::orderBy('name')->get(),
            'ingredientsCatalog' => Ingredient::orderBy('name')->get(),
            'selectedIngredients' => $recipe->ingredientsList->pluck('id')->all(),
            'categoryOptions' => $this->categoryOptions(),
            'difficultyOptions' => $this->difficultyOptions(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $this->authorizeRecipeOwner($recipe);

        $validated = $request->validate($this->recipeRules(false));

        $data = [
            'title' => $validated['title'],
            'summary' => $validated['summary'] ?? null,
            'ingredients' => $validated['ingredients'],
            'instructions' => $validated['instructions'],
            'cooking_time' => $validated['cooking_time'],
            'prep_time' => $validated['prep_time'] ?? null,
            'servings' => $validated['servings'] ?? null,
            'difficulty' => $validated['difficulty'] ?? null,
            'category' => $validated['category'],
            'video_url' => $validated['video_url'] ?? null,
            'region_id' => $validated['region_id'] ?? null,
            'dish_type_id' => $validated['dish_type_id'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }

            $data['image_path'] = $request->file('image')->storeAs(
                'images',
                Str::slug($validated['title']) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension(),
                'public'
            );
        }

        $recipe->update($data);
        $recipe->ingredientsList()->sync($validated['ingredient_ids'] ?? []);

        return redirect()->route('recipe.index')->with('success', 'Công thức đã được cập nhật thành công.');
    }

    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $this->authorizeRecipeOwner($recipe);

        if ($recipe->image_path) {
            Storage::disk('public')->delete($recipe->image_path);
        }

        $recipe->ingredientsList()->detach();
        $recipe->delete();

        return redirect()->route('recipe.index')->with('success', 'Công thức đã được xóa thành công.');
    }

    public function saveRating(Request $request)
    {
        $user = Auth::id();

        $rating = Rating::where('from_user', $user)
            ->where('recipe_id', $request->recipe_id)
            ->first();

        if ($rating) {
            $rating->delete();
        }

        Rating::create([
            'from_user' => $user,
            'recipe_id' => $request->recipe_id,
            'score' => $request->rating,
        ]);

        session()->flash('success', 'Đã thêm đánh giá!');

        return response()->json(['success' => 'Đã thêm đánh giá!']);
    }

    public function sendComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first('content');
            session()->flash('error', $message);

            return response()->json(['error' => $message], 422);
        }

        Comment::create([
            'recipe_id' => $request->recipeId,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Đã thêm bình luận!');

        $recipe = Recipe::find($request->recipeId);
        $message = Auth::user()->name . ' đã bình luận về công thức ' . $recipe->title;

        event(new CommentMessage($message, $recipe->user_id));

        return response()->json(['success' => 'Đã thêm bình luận!']);
    }

    protected function authorizeRecipeOwner(Recipe $recipe): void
    {
        abort_unless($recipe->user_id === Auth::id(), 403);
    }

    protected function recipeRules(bool $isCreate): array
    {
        $imageRule = $isCreate ? 'required|image|mimes:jpeg,png,jpg|max:2048' : 'nullable|image|mimes:jpeg,png,jpg|max:2048';

        return [
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string|max:500',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'image' => $imageRule,
            'cooking_time' => 'required|integer|min:1',
            'prep_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'difficulty' => 'nullable|in:Dễ,Trung bình,Khó',
            'category' => 'required|string|max:255',
            'video_url' => 'nullable|url|max:255',
            'region_id' => 'nullable|exists:regions,id',
            'dish_type_id' => 'nullable|exists:dish_types,id',
            'ingredient_ids' => 'nullable|array',
            'ingredient_ids.*' => 'exists:ingredients,id',
        ];
    }

    protected function categoryOptions(): array
    {
        return [
            'Bữa sáng' => 'Bữa sáng',
            'Bữa trưa' => 'Bữa trưa',
            'Bữa tối' => 'Bữa tối',
            'Ăn vặt' => 'Ăn vặt',
            'Món chính' => 'Món chính',
        ];
    }

    protected function difficultyOptions(): array
    {
        return [
            'Dễ' => 'Dễ',
            'Trung bình' => 'Trung bình',
            'Khó' => 'Khó',
        ];
    }
}