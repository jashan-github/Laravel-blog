<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index() {
        return view('blogs.index', [
            'blogs' => Blog::with('tags')
                ->filter(
                    request('search')
                )
                ->paginate(5),
        ]);
    }

    public function create() {
        return view('blogs.create', [
            'tags' => Tag::get(),
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tagIds' => [
                'bail',
                'required',
                'array',
                'min:1',
                Rule::in(Tag::get()->pluck('id')->toArray())
            ]
        ]);

        $validated += [
            'user_id' => Auth::id(),
        ];

        try {
            $blog = Blog::create($validated);
            $blog->tags()->attach($validated['tagIds']);

            return redirect(route('blogs'))->with('success', 'Blog created successfull!');
        } catch (\Throwable $th) {
            Log::info('Error when creating a blog: '. $th->getMessage());

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function view(Blog $blog) {
        return view('blogs.view', [
            'blog' => $blog->load('comments'),
        ]);
    }

    public function edit(Blog $blog) {
        return view('blogs.edit', [
            'blog' => $blog,
            'tags' => Tag::get(),
        ]);
    }

    public function update(Request $request, Blog $blog) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tagIds' => [
                'bail',
                'required',
                'array',
                'min:1',
                Rule::in(Tag::get()->pluck('id')->toArray())
            ]
        ]);

        try {
            $blog->update($validated);

            $tagIds = $validated['tagIds'];
            $newTagIds = collect($tagIds ?? []);

            $existingTagIds = $blog->tags()->get()->pluck('id');

            $attached = $newTagIds->diff($existingTagIds);

            $detached = $existingTagIds->diff($newTagIds);

            if (!$detached->isEmpty()) {
                $blog->tags()->detach($detached, [
                    'user_id' => $blog->id,
                ]);
            }
            if (!$attached->isEmpty()) {
                $blog->tags()->attach($attached, [
                    'blog_id' => $blog->id,
                ]);
            }

            return redirect(route('blogs'))->with('success', 'Blog updated successfull!');
        } catch (\Throwable $th) {
            Log::info('Error when updating a blog: '. $th->getMessage());

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy(Blog $blog) {
        $blog->delete();

        return back()->with('success', __('Blog Successfully Deleted!'));
    }
}
