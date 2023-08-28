<?php

namespace App\Listeners;

use App\Events\PostViewed;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdatePostViews implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostViewed $event): void
    {
        $post = Post::find($event->postId);

        $post->view += 1;
        $post->save();

        Log::info('Đã cập nhật số lượt xem cho bài viết là: ' . $post->view);
    }
}
