@extends('layout')
@section('content')

    <x-reply.modal-reply-comment />

    <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
        <div class="max-w-2xl mx-auto px-4">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments
                    ({{ $post->comments->count() }})</h2>
            </div>
            <x-comment.comment-create :post="$post" />

            @forelse($post->comments as $comment)
                <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900" id="comment-{{ $comment->id }}"
                    x-data="comments('comment')">

                    <template x-if="loading">
                        <div class=" text-white text-sm">Aguarde...</div>
                    </template>

                    <x-comment.comment :comment="$comment" />

                    <x-comment.comment-edit :comment="$comment" />

                </article>
                @foreach ($comment->replies as $reply)
                    <article id="reply-{{ $reply->id }}" data-parent-id="{{ $comment->id }}" x-data="comments('reply')"
                        class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900">

                        <template x-if="loading">
                            <div class=" text-white text-sm">Aguarde...</div>
                        </template>

                        <x-reply.reply :reply="$reply" />

                        <x-reply.reply-edit :reply="$reply" />

                    </article>
                @endforeach
            @empty
                <h2 class="text-3xl bold text-white">No comments, Be the first!</h2>
            @endforelse
        </div>
    </section>

@endsection
