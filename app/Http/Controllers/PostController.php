<?php

namespace App\Http\Controllers;

use App\Events\PostViewed;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function view($postId)
    {
        // Xem bài viết

        // Phát ra sự kiện PostViewed
        event(new PostViewed($postId));

        // Trả về phản hồi cho người dùng
        return response()->json(['message' => 'Bài viết đã được xem.']);
    }
}
