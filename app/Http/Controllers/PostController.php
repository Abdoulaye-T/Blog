<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('comment');
    }

    public function index(Request $request): View
    {
        return $this->postsView($request->search ? ['search'=> $request->search] : []);
    }

    //fltrer mes postes par categorie
    public function postsByCategory(Category $category): View
    {
        return $this->postsView(['category' => $category]);
    }

    //fltrer mes postes par tag
    public function postsByTag(Tag $tag): View
    {
        return $this->postsView(['tag' => $tag]);
    }

    protected function postsView(array $filters): View
    {
        return view('posts.index', [
            'posts' => Post::filters($filters)->latest()->paginate(10) 
        ]);
    }

    public function show(Post $post): View 
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function comment(Post $post, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'comment' => ['required', 'string', 'between:2,255']
        ]);

        Comment::create([
            'content' => $validated['comment'],
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return back()->withStatus('Commentaire publié !');

    }
}
