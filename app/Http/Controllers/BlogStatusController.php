<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogStatusController extends Controller
{
    public function update(Blog $blog)
    {
        try {
            if ($blog->status) {
                $blog->update([
                    'status' => Blog::INACTIVE,
                ]);
            } else {
                $blog->update([
                    'status' => Blog::ACTIVE,
                ]);
            }
            return back()->with('success', __('Blog status updated successfully!'));
        } catch (\Throwable $th) {
            Log::info('Error when change the status of an blog '.$blog.': '.$th);

            return back()->with('error', __('Something went wrong. Please try again!'));
        }
    }
}
