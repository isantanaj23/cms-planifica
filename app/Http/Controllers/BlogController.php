<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()
                    ->with(['category', 'author', 'tags'])
                    ->orderBy('is_sticky', 'desc')
                    ->orderBy('published_at', 'desc');

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filtro por tag
        if ($request->filled('tag')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Búsqueda
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $posts = $query->paginate(12);
        
        // Posts destacados para el hero
        $featuredPosts = Post::published()
                           ->featured()
                           ->orderBy('published_at', 'desc')
                           ->limit(3)
                           ->get();

        // Categorías para filtros
        $categories = Category::active()
                            ->ordered()
                            ->withCount('publishedPosts')
                            ->having('published_posts_count', '>', 0)
                            ->get();

        // Tags populares
        $popularTags = Tag::withCount('publishedPosts')
                         ->having('published_posts_count', '>', 0)
                         ->orderBy('published_posts_count', 'desc')
                         ->limit(10)
                         ->get();

        return view('blog.index', compact('posts', 'featuredPosts', 'categories', 'popularTags'));
    }

    public function show(Post $post)
    {
        // Solo mostrar posts publicados
        if (!$post->isPublished()) {
            abort(404);
        }

        // Incrementar contador de vistas
        $post->incrementViews();

        // Posts relacionados (misma categoría)
        $relatedPosts = Post::published()
                          ->where('category_id', $post->category_id)
                          ->where('id', '!=', $post->id)
                          ->orderBy('published_at', 'desc')
                          ->limit(4)
                          ->get();

        // Posts recientes
        $recentPosts = Post::published()
                         ->orderBy('published_at', 'desc')
                         ->limit(5)
                         ->get();

        return view('blog.post', compact('post', 'relatedPosts', 'recentPosts'));
    }

    public function category(Category $category)
    {
        $posts = $category->publishedPosts()
                         ->with(['author', 'tags'])
                         ->paginate(12);

        return view('blog.category', compact('category', 'posts'));
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->publishedPosts()
                    ->with(['category', 'author'])
                    ->orderBy('published_at', 'desc')
                    ->paginate(12);

        return view('blog.tag', compact('tag', 'posts'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('blog.index');
        }

        $posts = Post::published()
                   ->search($query)
                   ->with(['category', 'author', 'tags'])
                   ->orderBy('published_at', 'desc')
                   ->paginate(12);

        return view('blog.search', compact('posts', 'query'));
    }
}