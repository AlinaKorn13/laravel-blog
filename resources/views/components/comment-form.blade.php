@auth
    <div class="space-y-4 lg:text-lg leading-loose border rounded border-gray-500 px-3 py-2 mt-5">
        <span>Leave your comment.</span>
        <form action="/comments/{{ $post->slug }}/create" method="POST">
            @csrf
            <textarea class="inline-flex w-full" name="body" required>{{ old('body', request('body')) }}</textarea>
            <x-button type="submit" id="save_comment">Submit</x-button>
        </form>
    </div>
@else
    <p class="font-semibold px-3 py-2 mt-5 lg:text-lg text-center">
        <a href="/register" class="hover:underline">Register</a> or
        <a href="/login" class="hover:underline">log in</a> to leave a comment.
    </p>
@endauth
