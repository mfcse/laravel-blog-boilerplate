<?php

use App\Models\Post;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('post.created', function ($post) {
    info(auth()->user()->id);
    return (int) auth()->user()->id !== (int) $post->user_id;
});
// Broadcast::channel('post.created.{postId}', function ($postId) {
//     return (int) auth()->user()->id === (int) Post::findOrNew($postId)->user_id;
// });

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::channel('orders.{orderId}', function ($user, $orderId) {
//     return $user->id === Order::findOrNew($orderId)->user_id;
// });