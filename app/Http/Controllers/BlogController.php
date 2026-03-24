<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $featuredBlog = Blog::with('author')
            ->published()
            ->latest('published_at')
            ->first();

        $blogs = Blog::with('author')
            ->published()
            ->when($featuredBlog, fn ($query) => $query->whereKeyNot($featuredBlog->getKey()))
            ->latest('published_at')
            ->paginate(6);

        return view('blogs.index', [
            'featuredBlog' => $featuredBlog,
            'blogs' => $blogs,
        ]);
    }

    public function show(Blog $blog)
    {
        abort_unless(
            $blog->status === 'published'
                && filled($blog->published_at)
                && $blog->published_at->lte(now()),
            404
        );

        $blog->load('author');

        $relatedBlogs = Blog::with('author')
            ->published()
            ->whereKeyNot($blog->getKey())
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('blogs.show', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
        ]);
    }

    public function myIndex()
    {
        $userId = Auth::id();
        $blogs = Blog::where('from_user', $userId)->latest()->get();

        return view('blogs.manage', [
            'blogs' => $blogs,
            'publishedCount' => $blogs->where('status', 'published')->count(),
            'unpublishedCount' => $blogs->where('status', 'unpublished')->count(),
        ]);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $isAdmin = $user?->role === 'admin';
        $status = $isAdmin ? 'published' : 'unpublished';

        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->storeAs(
                'blog-thumbnails',
                Str::slug($validated['title']) . '-' . time() . '.' . $request->file('thumbnail')->getClientOriginalExtension(),
                'public'
            )
            : null;

        Blog::create([
            'from_user' => $user->id,
            'title' => $validated['title'],
            'slug' => $this->generateUniqueSlug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? null,
            'content' => nl2br(e($validated['content'])),
            'thumbnail_path' => $thumbnailPath,
            'status' => $status,
            'published_at' => $status === 'published' ? now() : null,
        ]);

        return redirect()->route('my-blogs.index')->with('success', $isAdmin
            ? 'Bài viết đã được tạo và xuất bản.'
            : 'Bài viết đã được tạo ở trạng thái chưa xuất bản.');
    }

    public function destroy(Blog $blog)
    {
        abort_unless($blog->from_user === Auth::id(), 403);

        if ($blog->thumbnail_path) {
            Storage::disk('public')->delete($blog->thumbnail_path);
        }

        $blog->delete();

        return redirect()->route('my-blogs.index')->with('success', 'Bài viết đã được xóa.');
    }

    protected function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}