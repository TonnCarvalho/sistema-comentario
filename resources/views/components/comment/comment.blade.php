@props(['comment'])
<div x-show="!canEdit">
    <footer class="flex justify-between items-center mb-2 relative">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                <img class="mr-2 w-6 h-6 rounded-full" src="{{ $comment->user->photo }}"
                    alt="{{ $comment->user->fullName }}">{{ $comment->user->fullName }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                    title="{{ $comment->created_at->translatedFormat('d F Y h:i:s') }}">
                    {{ $comment->created_at->translatedFormat('d F Y h:i:s') }}
                </time></p>
        </div>
        <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-700  cursor-pointer"
            type="button" x-on:click="openDropdown = !openDropdown">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 16 3">
                <path
                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
            </svg>
            <span class="sr-only">Comment settings</span>
        </button>
        <!-- Dropdown menu -->
        <x-dropdown-comments :comment="$comment" />
    </footer>

    <p x-ref="originalComment" class="text-gray-500 dark:text-gray-400">
        {{ $comment->comment }}
    </p>
</div>
