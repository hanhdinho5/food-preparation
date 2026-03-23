<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['recipe.user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('comments.index', [
            'comments' => $comments,
        ]);
    }
}