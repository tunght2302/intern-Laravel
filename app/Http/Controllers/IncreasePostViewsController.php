<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Jobs\IncreasePostViews;
class IncreasePostViewsController extends Controller
{
    public function index ()
    {
        $idPost = 1;
        $post = Post::find($idPost);
        IncreasePostViews::dispatch($post);
    }
}
