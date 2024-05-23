<?php

namespace App\Http\Controllers;

use App\Mail\ShareBlog;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShareBlogController extends Controller
{
    public function shareUserDetail(Blog $blog) {
        return view('blogs.share', [
            'blog' => $blog,
        ]);
    }

    public function send(Request $request, Blog $blog)
    {
        $request->validate([
            'recipient_email' => 'required|email',
            'recipient_name' => 'required|string',
        ]);

        $recipientEmail = $request->recipient_email;
        $recipientName = $request->recipient_name;

        Mail::to($recipientEmail)->send(new ShareBlog($blog, $recipientName));

        return back()->with('success', 'Blog shared successfully!');
    }
}
