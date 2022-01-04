@props(['post'])

<div class="flex items-center lg:justify-center text-sm mt-4">
    <img src="https://i.pravatar.cc/60?u={{ $post->user_id }}" alt="Lary avatar">
    <div class="ml-3 text-left">
        <h5 class="font-bold">{{ $post->author->name }}</h5>
        <h6>Mascot at Laracasts</h6>
    </div>
</div>
