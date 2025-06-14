<?php

use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    Auth::loginUsingId(1);
})->name('home');

Route::get('/post/{post}', function (Post $post) {
    $post->load('comments.replies');
    return view('post.show', compact('post'));
})->middleware('auth');

Route::post('/comment/{postId}', function ($postId) {

    $validated = request()->validate([
        'comment' => 'required|max:100'
    ]);

    Comment::create([
        'post_id' => $postId,
        'user_id' => Auth::id(),
        'comment' => $validated['comment']
    ]);

    return back()->with('success', 'Comment created successfully');
})->name('comment.store');

Route::put('/comment/{comment}', function (Comment $comment) {
    $validated = request()->validate([
        'comment' => 'required|max:100'
    ]);
    Gate::authorize('update', $comment);

    $comment->comment = $validated['comment'];
    $comment->save();

    return response()->json(['message' => 'Comment update successfully']);
})->name('comment.put');

Route::delete('/comment/{comment}', function (Comment $comment) {
    Gate::authorize('delete', $comment);

    $comment->delete();

    return response()->json(['message' => 'Comment deleted successfully']);
})->name('comment.delete');

Route::post('/reply-comment', function () {
    $validated = request()->validate([
        'comment_id' => 'required',
        'post_id' => 'required',
        'reply' => 'required|max:100'
    ]);
    Reply::create([
        'comment_id' => request()->comment_id,
        'post_id' => request()->post_id,
        'user_id' => Auth::id(),
        'reply' => $validated['reply']
    ]);


    return response()->json(['message' => 'Reply successfully']);
})->name('reply.post');

Route::put('/reply/{reply}', function (Reply $reply) {
    $validated = request()->validate([
        'reply' => 'required|max:100'
    ]);

    Gate::authorize('update', $reply);

    return response()->json(['message' => 'Reply update successfully']);
})->name('reply.put');

Route::delete('/reply/{reply}', function (Reply $reply) {
    Gate::authorize('delete', $reply);
    return response()->json(['message' => 'Reply deleted successfully']);
})->name('reply.delete');
