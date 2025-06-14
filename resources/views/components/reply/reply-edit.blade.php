@props(['reply'])

<div x-cloak x-show="canEdit">

    <template x-if="errorValidateEdit">
        <div x-text="errorValidateEdit" class="text-red-600 italic text-sm"></div>
    </template>

    <textarea x-ref="comment" id="comment" name="reply" rows="6"
        class="p-2 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded-lg rounded-t-lg"
        placeholder="Write a comment...">
    </textarea>

    <button x-on:click='updateComment({{ $reply->id }})' class="bg-green-400 p-2 rounded text-xs cursor-pointer">
        Update
    </button>
    <button x-on:click="canEdit=false; errorValidateEdit=''" class="bg-amber-400 p-2 rounded text-xs cursor-pointer">
        Back to back
    </button>


</div>
