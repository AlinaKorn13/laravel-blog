<header class="max-w-xl mx-auto my-15 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Laravel From Scratch</span> News
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <!--  Category -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl py-2 px-5">
            <x-dropdown align="center" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-bold hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="'/'" :active="request()->routeIs('home') && is_null(request()->getQueryString())">
                        All
                    </x-dropdown-link>
                    @foreach ($categories as $category)
                        <x-dropdown-link
                            href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}"
                            :active='request()->fullUrlIs("*?category={$category->slug}*")'
                        >
                            {{ ucfirst($category->name) }}
                        </x-dropdown-link>
                    @endforeach
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3">
            <form method="GET" action="#">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text"
                       name="search"
                       placeholder="Find something"
                       class="bg-transparent placeholder-black font-semibold text-sm border-0"
                       value="{{ request('search') }}"
                >
            </form>
        </div>
    </div>
</header>
