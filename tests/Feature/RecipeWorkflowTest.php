<?php

use App\Models\DishType;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Region;
use App\Models\User;

it('filters dashboard recipes by region and available ingredients', function () {
    $user = User::factory()->create();

    $north = Region::create(['name' => 'Miền Bắc', 'slug' => 'mien-bac']);
    $south = Region::create(['name' => 'Miền Nam', 'slug' => 'mien-nam']);
    $soup = DishType::create(['name' => 'Món nước', 'slug' => 'mon-nuoc']);
    $grill = DishType::create(['name' => 'Món nướng', 'slug' => 'mon-nuong']);
    $beef = Ingredient::create(['name' => 'Thịt bò', 'slug' => 'thit-bo']);
    $shrimp = Ingredient::create(['name' => 'Tôm', 'slug' => 'tom']);

    $matchingRecipe = Recipe::create([
        'title' => 'Phở bò',
        'summary' => 'Món nước miền Bắc',
        'ingredients' => 'Thịt bò, bánh phở',
        'instructions' => 'Nấu nước dùng',
        'cooking_time' => 45,
        'prep_time' => 20,
        'servings' => 4,
        'difficulty' => 'Trung bình',
        'category' => 'Bữa sáng',
        'image_path' => 'images/pho-bo.jpg',
        'status' => 'published',
        'user_id' => $user->id,
        'region_id' => $north->id,
        'dish_type_id' => $soup->id,
    ]);
    $matchingRecipe->ingredientsList()->attach($beef->id);

    $otherRecipe = Recipe::create([
        'title' => 'Tôm nướng',
        'summary' => 'Món nướng miền Nam',
        'ingredients' => 'Tôm, muối ớt',
        'instructions' => 'Ướp rồi nướng',
        'cooking_time' => 20,
        'prep_time' => 10,
        'servings' => 2,
        'difficulty' => 'Dễ',
        'category' => 'Bữa tối',
        'image_path' => 'images/tom-nuong.jpg',
        'status' => 'published',
        'user_id' => $user->id,
        'region_id' => $south->id,
        'dish_type_id' => $grill->id,
    ]);
    $otherRecipe->ingredientsList()->attach($shrimp->id);

    $response = $this->actingAs($user)->get(route('dashboard', [
        'region' => $north->id,
        'available_ingredients' => [$beef->id],
    ]));

    $response->assertOk();
    $response->assertSee('Phở bò');
    $response->assertDontSee('Tôm nướng');
    $response->assertSee('Khớp 1 nguyên liệu sẵn có');
});

it('forbids users from editing recipes they do not own', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();

    $recipe = Recipe::create([
        'title' => 'Bún bò Huế',
        'summary' => 'Món Huế',
        'ingredients' => 'Bún, thịt bò',
        'instructions' => 'Nấu nước dùng',
        'cooking_time' => 60,
        'category' => 'Bữa trưa',
        'image_path' => 'images/bun-bo-hue.jpg',
        'status' => 'published',
        'user_id' => $owner->id,
    ]);

    $response = $this->actingAs($otherUser)->get(route('recipe.edit', $recipe));

    $response->assertForbidden();
});