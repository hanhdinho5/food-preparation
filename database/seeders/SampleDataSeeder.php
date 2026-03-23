<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\DishType;
use App\Models\Favorite;
use App\Models\Ingredient;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        Comment::query()->delete();
        Favorite::query()->delete();
        Rating::query()->delete();
        DB::table('ingredient_recipe')->delete();
        Recipe::query()->delete();
        Ingredient::query()->delete();
        DishType::query()->delete();
        Region::query()->delete();
        User::query()->where('role', 'user')->delete();
        User::query()->where('email', 'admin@mail.com')->delete();

        $regions = collect([
            ['name' => 'Miền Bắc', 'description' => 'Ẩm thực thanh vị, tinh tế và cân bằng.'],
            ['name' => 'Miền Trung', 'description' => 'Ẩm thực đậm đà, cay nồng và giàu bản sắc địa phương.'],
            ['name' => 'Miền Nam', 'description' => 'Ẩm thực phóng khoáng, ngọt dịu và đa dạng nguyên liệu.'],
        ])->mapWithKeys(fn (array $region) => [
            $region['name'] => Region::create([
                'name' => $region['name'],
                'slug' => Str::slug($region['name']),
                'description' => $region['description'],
            ]),
        ]);

        $dishTypes = collect([
            'Món nước',
            'Món xào',
            'Món nướng',
            'Món cuốn',
            'Món canh',
        ])->mapWithKeys(fn (string $name) => [
            $name => DishType::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]),
        ]);

        $ingredientNames = [
            ['name' => 'Bánh phở', 'group_name' => 'Tinh bột'],
            ['name' => 'Thịt bò', 'group_name' => 'Thịt'],
            ['name' => 'Hành tây', 'group_name' => 'Rau củ'],
            ['name' => 'Gừng', 'group_name' => 'Gia vị'],
            ['name' => 'Quế', 'group_name' => 'Gia vị'],
            ['name' => 'Cơm nguội', 'group_name' => 'Tinh bột'],
            ['name' => 'Trứng gà', 'group_name' => 'Trứng'],
            ['name' => 'Xá xíu', 'group_name' => 'Thịt'],
            ['name' => 'Đậu Hà Lan', 'group_name' => 'Rau củ'],
            ['name' => 'Cà rốt', 'group_name' => 'Rau củ'],
            ['name' => 'Bún tươi', 'group_name' => 'Tinh bột'],
            ['name' => 'Thịt ba chỉ', 'group_name' => 'Thịt'],
            ['name' => 'Thịt xay', 'group_name' => 'Thịt'],
            ['name' => 'Nước mắm', 'group_name' => 'Gia vị'],
            ['name' => 'Đu đủ xanh', 'group_name' => 'Rau củ'],
            ['name' => 'Cá basa', 'group_name' => 'Hải sản'],
            ['name' => 'Cà chua', 'group_name' => 'Rau củ'],
            ['name' => 'Dứa', 'group_name' => 'Trái cây'],
            ['name' => 'Bạc hà', 'group_name' => 'Rau củ'],
            ['name' => 'Me chua', 'group_name' => 'Gia vị'],
            ['name' => 'Bánh tráng', 'group_name' => 'Tinh bột'],
            ['name' => 'Tôm', 'group_name' => 'Hải sản'],
            ['name' => 'Bún', 'group_name' => 'Tinh bột'],
            ['name' => 'Xà lách', 'group_name' => 'Rau củ'],
        ];

        $ingredients = collect($ingredientNames)->mapWithKeys(fn (array $ingredient) => [
            $ingredient['name'] => Ingredient::create([
                'name' => $ingredient['name'],
                'slug' => Str::slug($ingredient['name']),
                'group_name' => $ingredient['group_name'],
            ]),
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin_user'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $users = collect([
            ['name' => 'Nguyen Van An', 'email' => 'an@example.com'],
            ['name' => 'Tran Minh Chau', 'email' => 'chau@example.com'],
            ['name' => 'Le Hoang Duc', 'email' => 'duc@example.com'],
            ['name' => 'Pham Thu Ha', 'email' => 'ha@example.com'],
        ])->map(fn (array $user) => User::create([
            ...$user,
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]));

        $recipesData = [
            [
                'title' => 'Phở bò tái',
                'summary' => 'Món nước truyền thống với nước dùng trong, thơm mùi quế hồi và thịt bò tái mềm.',
                'ingredients' => "Bánh phở\nThịt bò tái\nHành tây\nGừng nướng\nQuế hồi",
                'instructions' => "Hầm xương bò lấy nước dùng.\nTrần bánh phở.\nXếp thịt bò và rau ăn kèm.\nChan nước dùng đang sôi.",
                'cooking_time' => 45,
                'prep_time' => 20,
                'servings' => 4,
                'difficulty' => 'Trung bình',
                'category' => 'Món nước',
                'image_path' => 'recipes/pho-bo.jpg',
                'video_url' => null,
                'status' => 'published',
                'user_id' => $users[0]->id,
                'region_id' => $regions['Miền Bắc']->id,
                'dish_type_id' => $dishTypes['Món nước']->id,
                'ingredient_names' => ['Bánh phở', 'Thịt bò', 'Hành tây', 'Gừng', 'Quế'],
            ],
            [
                'title' => 'Cơm chiên Dương Châu',
                'summary' => 'Món cơm chiên quen thuộc với màu sắc hài hòa, phù hợp cho bữa trưa nhanh gọn.',
                'ingredients' => "Cơm nguội\nTrứng gà\nXá xíu\nĐậu Hà Lan\nCà rốt",
                'instructions' => "Đánh trứng và chiên sơ.\nXào rau củ.\nCho cơm vào đảo đều với gia vị.\nTrộn cùng trứng và xá xíu.",
                'cooking_time' => 20,
                'prep_time' => 15,
                'servings' => 2,
                'difficulty' => 'Dễ',
                'category' => 'Món xào',
                'image_path' => 'recipes/com-chien.jpg',
                'video_url' => null,
                'status' => 'published',
                'user_id' => $users[1]->id,
                'region_id' => $regions['Miền Nam']->id,
                'dish_type_id' => $dishTypes['Món xào']->id,
                'ingredient_names' => ['Cơm nguội', 'Trứng gà', 'Xá xíu', 'Đậu Hà Lan', 'Cà rốt'],
            ],
            [
                'title' => 'Bún chả Hà Nội',
                'summary' => 'Món ăn nổi tiếng miền Bắc với thịt nướng thơm, nước chấm chua ngọt và bún tươi.',
                'ingredients' => "Bún tươi\nThịt ba chỉ\nThịt xay\nNước mắm\nĐu đủ xanh",
                'instructions' => "Ướp thịt với gia vị.\nNướng thịt đến khi xém cạnh.\nPha nước chấm chua ngọt.\nĂn cùng bún và rau sống.",
                'cooking_time' => 35,
                'prep_time' => 20,
                'servings' => 3,
                'difficulty' => 'Trung bình',
                'category' => 'Món nướng',
                'image_path' => 'recipes/bun-cha.jpg',
                'video_url' => null,
                'status' => 'published',
                'user_id' => $users[2]->id,
                'region_id' => $regions['Miền Bắc']->id,
                'dish_type_id' => $dishTypes['Món nướng']->id,
                'ingredient_names' => ['Bún tươi', 'Thịt ba chỉ', 'Thịt xay', 'Nước mắm', 'Đu đủ xanh'],
            ],
            [
                'title' => 'Canh chua cá',
                'summary' => 'Canh chua thanh mát đặc trưng miền Nam với cá, me và rau thơm.',
                'ingredients' => "Cá basa\nCà chua\nDứa\nBạc hà\nMe chua",
                'instructions' => "Nấu nước me.\nCho cá vào nấu chín.\nThêm rau củ và nêm lại.\nRắc ngò ôm và rau quế.",
                'cooking_time' => 30,
                'prep_time' => 15,
                'servings' => 4,
                'difficulty' => 'Dễ',
                'category' => 'Món canh',
                'image_path' => 'recipes/canh-chua.jpg',
                'video_url' => null,
                'status' => 'published',
                'user_id' => $users[3]->id,
                'region_id' => $regions['Miền Nam']->id,
                'dish_type_id' => $dishTypes['Món canh']->id,
                'ingredient_names' => ['Cá basa', 'Cà chua', 'Dứa', 'Bạc hà', 'Me chua'],
            ],
            [
                'title' => 'Gỏi cuốn tôm thịt',
                'summary' => 'Món cuốn thanh nhẹ, dễ ăn, thích hợp khai vị hoặc bữa ăn nhẹ.',
                'ingredients' => "Bánh tráng\nTôm luộc\nThịt ba chỉ\nBún\nXà lách",
                'instructions' => "Sơ chế nhân cuốn.\nLàm mềm bánh tráng.\nCuốn chặt tay với rau và bún.\nDùng kèm nước chấm đậu phộng.",
                'cooking_time' => 15,
                'prep_time' => 20,
                'servings' => 3,
                'difficulty' => 'Dễ',
                'category' => 'Món cuốn',
                'image_path' => 'recipes/goi-cuon.jpg',
                'video_url' => null,
                'status' => 'published',
                'user_id' => $users[0]->id,
                'region_id' => $regions['Miền Nam']->id,
                'dish_type_id' => $dishTypes['Món cuốn']->id,
                'ingredient_names' => ['Bánh tráng', 'Tôm', 'Thịt ba chỉ', 'Bún', 'Xà lách'],
            ],
        ];

        $recipes = collect($recipesData)->map(function (array $recipeData) use ($ingredients) {
            $ingredientNames = $recipeData['ingredient_names'];
            unset($recipeData['ingredient_names']);

            $recipe = Recipe::create($recipeData);
            $recipe->ingredientsList()->sync(
                collect($ingredientNames)->mapWithKeys(fn (string $name) => [
                    $ingredients[$name]->id => ['note' => null],
                ])->all()
            );

            return $recipe;
        });

        Rating::insert([
            ['score' => 5, 'recipe_id' => $recipes[0]->id, 'from_user' => $users[1]->id, 'created_at' => now(), 'updated_at' => now()],
            ['score' => 4, 'recipe_id' => $recipes[1]->id, 'from_user' => $users[2]->id, 'created_at' => now(), 'updated_at' => now()],
            ['score' => 5, 'recipe_id' => $recipes[2]->id, 'from_user' => $users[3]->id, 'created_at' => now(), 'updated_at' => now()],
            ['score' => 4, 'recipe_id' => $recipes[3]->id, 'from_user' => $users[0]->id, 'created_at' => now(), 'updated_at' => now()],
            ['score' => 5, 'recipe_id' => $recipes[4]->id, 'from_user' => $admin->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Favorite::insert([
            ['user_id' => $users[0]->id, 'recipe_id' => $recipes[1]->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[1]->id, 'recipe_id' => $recipes[2]->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[2]->id, 'recipe_id' => $recipes[3]->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[3]->id, 'recipe_id' => $recipes[4]->id, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[1]->id, 'recipe_id' => $recipes[0]->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        Comment::insert([
            ['user_id' => $users[1]->id, 'recipe_id' => $recipes[0]->id, 'content' => 'Nước dùng đậm vị, mình sẽ nấu lại món này.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[2]->id, 'recipe_id' => $recipes[1]->id, 'content' => 'Công thức dễ làm và hợp bữa trưa văn phòng.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[3]->id, 'recipe_id' => $recipes[2]->id, 'content' => 'Phần nước chấm rất quan trọng, mình thấy ngon.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $users[0]->id, 'recipe_id' => $recipes[3]->id, 'content' => 'Canh chua thanh nhẹ, ăn cùng cơm rất hợp.', 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => $admin->id, 'recipe_id' => $recipes[4]->id, 'content' => 'Món khai vị này trình bày đẹp và dễ bán.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}