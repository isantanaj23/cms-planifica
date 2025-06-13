<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author'])
                    ->orderBy('created_at', 'desc');

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $posts = $query->paginate(15);
        $categories = Category::active()->ordered()->get();
        
        $stats = [
            'total' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'draft' => Post::where('status', 'draft')->count(),
            'scheduled' => Post::where('status', 'scheduled')->count(),
        ];

        return view('admin.posts.index', compact('posts', 'categories', 'stats'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        $tags = Tag::orderBy('name')->get();
        
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
            
            $originalSlug = $validated['slug'];
            $counter = 1;
            
            while (Post::where('slug', $validated['slug'])->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Manejar fecha de publicación
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Subir imagen destacada
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts/featured', 'public');
        }

        // Asignar autor
        $validated['user_id'] = Auth::id();

        // Generar meta título si no existe
        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title'] . ' | Planifica+ Blog';
        }

        // Generar meta descripción si no existe
        if (empty($validated['meta_description'])) {
            $validated['meta_description'] = $validated['excerpt'] ?: 
                Str::limit(strip_tags($validated['content']), 160);
        }

        $post = Post::create($validated);

        // Asignar tags
        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post creado exitosamente.');
    }

    public function show(Post $post)
    {
        $post->load(['category', 'author', 'tags', 'images']);
        
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::active()->ordered()->get();
        $tags = Tag::orderBy('name')->get();
        $selectedTags = $post->tags->pluck('id')->toArray();
        
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,scheduled,archived',
            'published_at' => 'nullable|date',
            'scheduled_at' => 'nullable|date|after:now',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_alt' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        // Manejar cambio de estado a publicado
        if ($validated['status'] === 'published' && $post->status !== 'published') {
            $validated['published_at'] = $validated['published_at'] ?: now();
        }

        // Subir nueva imagen destacada
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $validated['featured_image'] = $request->file('featured_image')
                ->store('posts/featured', 'public');
        }

        $post->update($validated);

        // Actualizar tags
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()
            ->route('admin.posts.show', $post)
            ->with('success', 'Post actualizado exitosamente.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Post eliminado exitosamente.');
    }

    public function publish(Post $post)
    {
        $post->update([
            'status' => 'published',
            'published_at' => now()
        ]);

        return back()->with('success', 'Post publicado exitosamente.');
    }

    public function unpublish(Post $post)
    {
        $post->update(['status' => 'draft']);

        return back()->with('success', 'Post despublicado exitosamente.');
    }

    public function duplicate(Post $post)
    {
        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copia)';
        $newPost->slug = Str::slug($newPost->title);
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->scheduled_at = null;
        $newPost->views_count = 0;
        $newPost->likes_count = 0;
        $newPost->is_featured = false;
        $newPost->save();

        $newPost->tags()->sync($post->tags->pluck('id'));

        return redirect()
            ->route('admin.posts.edit', $newPost)
            ->with('success', 'Post duplicado exitosamente.');
    }

    public function preview(Post $post)
    {
        return view('blog.post', compact('post'));
    }
}