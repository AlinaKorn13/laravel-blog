<x-app-layout>
    @include('posts.header')

    @if ($posts->count())
        <x-main-card :post="$posts[0]"/>

        @if ($posts->count() > 1)
            <div class="lg:grid lg:grid-cols-6">
                @foreach ($posts->skip(1) as $post)
                    <x-post-card
                        :post="$post"
                        class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}"
                    />
                @endforeach
            </div>
        @endif

        {{ $posts->links() }}
    @else
        <p class="text-center">No posts found.</p>
    @endif
</x-app-layout>
