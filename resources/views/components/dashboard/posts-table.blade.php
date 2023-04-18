<table class="table-auto w-full">
    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
        <tr>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Author</div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Title</div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Comments</div>
            </th>
            <th class="p-2 whitespace-nowrap">
                <div class="font-semibold text-left">Date</div>
            </th>
            <th colspan="2" class="p-2 whitespace-nowrap">
                <div class="font-semibold text-center">Action</div>
            </th>
        </tr>
    </thead>
    <tbody class="text-sm divide-y divide-gray-100">
        @foreach($posts as $post)
            <tr>
                <td class="p-2 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div>
                        <div class="font-medium text-gray-800">{{ $post->author->name }}</div>
                    </div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left">{{ count($post->comments) }}</div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-left font-medium">{{ $post->created_at }}</div>
                </td>
                <td class="p-2 whitespace-nowrap">
                    <div class="text-lg text-center">
                        <a href="/admin/posts/{{ $post->id }}/edit">Edit</a>
                    </div>
                </td>
                <td>
                    <form method="POST" action="/admin/posts/{{ $post->id }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-xs text-gray-400">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
