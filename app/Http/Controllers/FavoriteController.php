<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        $favorite_recipe = Favorite::join('recipes as r', 'r.id', '=', 'favorites.recipe_id')
                            ->where('favorites.user_id', $user)
                            ->get();

        return view('favorite.index', ['favorite_recipe' => $favorite_recipe]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;

        $favorite = Favorite::where('user_id', $user)
                            ->where('recipe_id', $request->recipe_id)
                            ->first();

        if ($favorite) {
            $favorite->delete();

            session()->flash('success', 'Đã xóa công thức khỏi danh sách yêu thích!');

            return response()->json(['message' => 'Đã xóa công thức khỏi danh sách yêu thích!', 'favorited' => false]);
        }

        Favorite::create(['user_id' => $user, 'recipe_id' => $request->recipe_id]);

        session()->flash('success', 'Đã thêm công thức vào danh sách yêu thích!');

        return response()->json(['message' => 'Đã thêm công thức vào danh sách yêu thích!', 'favorited' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}