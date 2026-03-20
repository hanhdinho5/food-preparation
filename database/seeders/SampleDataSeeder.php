<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Seed the application's sample data.
     */
    public function run(): void
    {
        Comment::query()->delete();
        Favorite::query()->delete();
        Rating::query()->delete();
        Recipe::query()->delete();
        User::query()->where('role', 'user')->delete();
        User::query()->where('email', 'admin@mail.com')->delete();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin_user'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $users = collect([
            [
                'name' => 'Nguyen Van An',
                'email' => 'an@example.com',
            ],
            [
                'name' => 'Tran Minh Chau',
                'email' => 'chau@example.com',
            ],
            [
                'name' => 'Le Hoang Duc',
                'email' => 'duc@example.com',
            ],
            [
                'name' => 'Pham Thu Ha',
                'email' => 'ha@example.com',
            ],
        ])->map(fn (array $user) => User::create([
            ...$user,
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]));

        $recipes = collect([
            [
                'title' => 'Pho Bo Tai',
                'ingredients' => "Banh pho\nThit bo tai\nHanh tay\nGung nuong\nQue hoi",
                'instructions' => "Ham xuong bo lay nuoc dung.\nTran banh pho.\nXep thit bo va rau an kem.\nChan nuoc dung dang soi.",
                'cooking_time' => 45,
                'category' => 'Mon nuoc',
                'image_path' => 'recipes/pho-bo.jpg',
                'user_id' => $users[0]->id,
            ],
            [
                'title' => 'Com Chien Duong Chau',
                'ingredients' => "Com nguoi\nTrung ga\nXa xiu\nDau Ha Lan\nCa rot",
                'instructions' => "Danh trung va chien so.\nXao rau cu.\nCho com vao dao deu voi gia vi.\nTron cung trung va xa xiu.",
                'cooking_time' => 20,
                'category' => 'Mon xao',
                'image_path' => 'recipes/com-chien.jpg',
                'user_id' => $users[1]->id,
            ],
            [
                'title' => 'Bun Cha Ha Noi',
                'ingredients' => "Bun tuoi\nThit ba chi\nThit xay\nNuoc mam\nDu du xanh",
                'instructions' => "Uop thit voi gia vi.\nNuong thit den khi xay canh.\nPha nuoc cham chua ngot.\nAn cung bun va rau song.",
                'cooking_time' => 35,
                'category' => 'Mon nuong',
                'image_path' => 'recipes/bun-cha.jpg',
                'user_id' => $users[2]->id,
            ],
            [
                'title' => 'Canh Chua Ca',
                'ingredients' => "Ca basa\nCa chua\nDua gia\nBac ha\nMe chua",
                'instructions' => "Nau nuoc me.\nCho ca vao nau chin.\nThem rau cu va nem lai.\nRac ngo om va rau que.",
                'cooking_time' => 30,
                'category' => 'Canh',
                'image_path' => 'recipes/canh-chua.jpg',
                'user_id' => $users[3]->id,
            ],
            [
                'title' => 'Goi Cuon Tom Thit',
                'ingredients' => "Banh trang\nTom luoc\nThit ba chi\nBun tuoi\nXa lach",
                'instructions' => "So che nhan cuon.\nLam mem banh trang.\nCuon chat tay voi rau va bun.\nDung kem nuoc cham dau phong.",
                'cooking_time' => 15,
                'category' => 'Khai vi',
                'image_path' => 'recipes/goi-cuon.jpg',
                'user_id' => $users[0]->id,
            ],
        ])->map(fn (array $recipe) => Recipe::create($recipe));

        Rating::insert([
            [
                'score' => 5,
                'recipe_id' => $recipes[0]->id,
                'from_user' => $users[1]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'score' => 4,
                'recipe_id' => $recipes[1]->id,
                'from_user' => $users[2]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'score' => 5,
                'recipe_id' => $recipes[2]->id,
                'from_user' => $users[3]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'score' => 4,
                'recipe_id' => $recipes[3]->id,
                'from_user' => $users[0]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'score' => 5,
                'recipe_id' => $recipes[4]->id,
                'from_user' => $admin->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Favorite::insert([
            [
                'user_id' => $users[0]->id,
                'recipe_id' => $recipes[1]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[1]->id,
                'recipe_id' => $recipes[2]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[2]->id,
                'recipe_id' => $recipes[3]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[3]->id,
                'recipe_id' => $recipes[4]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[1]->id,
                'recipe_id' => $recipes[0]->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        Comment::insert([
            [
                'user_id' => $users[1]->id,
                'recipe_id' => $recipes[0]->id,
                'content' => 'Nuoc dung dam vi, minh se nau lai mon nay.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[2]->id,
                'recipe_id' => $recipes[1]->id,
                'content' => 'Cong thuc de lam va hop bua trua van phong.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[3]->id,
                'recipe_id' => $recipes[2]->id,
                'content' => 'Phan nuoc cham rat quan trong, minh thay ngon.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $users[0]->id,
                'recipe_id' => $recipes[3]->id,
                'content' => 'Canh chua thanh nhe, an cung com rat hop.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'recipe_id' => $recipes[4]->id,
                'content' => 'Mon khai vi nay trinh bay dep va de ban.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
