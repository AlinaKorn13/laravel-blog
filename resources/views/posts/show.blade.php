<x-app-layout>
    <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10" data-post_id="{{ $post->id }}">
        <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl">

            <p class="mt-4 block text-gray-400 text-xs">
                Published <time>{{ $post->created_at->diffForHumans() }}</time>
            </p>

            <p class="mt-4 block text-gray-400 text-xs views">
                <span>{{ $post->views }}</span> views
            </p>

            <p class="mt-4 block">
                <button id="like_btn" class="p-1.5 text-gray-400 text-xs border bottom-1.5 rounded hover:bg-gray-500 hover:text-white">Like (<span>{{ $post->likes }}</span>)</button>
            </p>

            <x-author-avatar :post="$post" />
        </div>

        <div class="col-span-8">
            <div class="hidden lg:flex justify-between mb-6">
                <a href="/"
                   class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                    <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                        <g fill="none" fill-rule="evenodd">
                            <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                            </path>
                            <path class="fill-current"
                                  d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                            </path>
                        </g>
                    </svg>

                    Back to Posts
                </a>

                <x-category-label :category="$post->category"></x-category-label>
            </div>

            <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                {{ $post->title }}
            </h1>

            <div class="space-y-4 lg:text-lg leading-loose">
                <p>{{ $post->body }}</p>
            </div>

            <x-comment-form :post="$post" />

            <div class="space-y-4 lg:text-lg leading-loose mt-5" id="comments_container">
                @if (count($post->comments) > 0)
                    @foreach ($post->comments as $comment)
                        @include('posts.comment')
                    @endforeach
                @else
                    <p class="text-center mt-5">No comments yet.</p>
                @endif
            </div>
        </div>
    </article>
</x-app-layout>
