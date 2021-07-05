<?php

namespace App\Listeners;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class PostCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //info('event fired');
        cache()->forget('articles');

        //info(cache('articles'));
        $posts = Post::with('user', 'category')->orderBy('created_at', 'DESC')->take(20)->get();
        Cache::forever('articles', $posts);
        //cache('articles', $posts);

        //info(cache('articles'));
    }
}