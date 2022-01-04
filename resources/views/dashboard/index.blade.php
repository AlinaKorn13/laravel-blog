<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="/admin/posts/new" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase mb-3 hover:bg-gray-700 active:bg-gray-900">Create Post</a>
                    <x-dashboard.posts-table :posts="$posts"></x-dashboard.posts-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
