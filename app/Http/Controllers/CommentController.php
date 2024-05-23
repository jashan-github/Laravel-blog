<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog) {
        $attributes = $request->validate([
            'name' => 'required',
        ]);

        try {
            Comment::create([
                'name' => $attributes['name'],
                'user_id' => Auth::id(),
                'blog_id' => $blog->id,
            ]);

            return back()->with('success', 'Comment successfully posted!');
        } catch (\Throwable $th) {
            Log::info('Error when create a comment of an item '.$blog.': '.$th);

            return back()->with('error', __('Something went wrong. Please try again!'));
        }
    }

    public function like(Comment $comment)
    {
        $like = $comment->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create([
                'user_id' => Auth::id()
            ]);
        }

        return redirect(route('blogs.view', $comment->blog).'#likeForm');
    }
}
