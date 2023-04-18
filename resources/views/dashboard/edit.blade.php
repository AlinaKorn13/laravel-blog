<x-app-layout>

    <div class="md:flex md:items-center mb-6 w-full">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <h2 class="text-3xl">Edit Post:  {{$post->title}}</h2>
        </div>
    </div>
    <form class="w-full" method="POST" action="/admin/posts/{{ $post->id }}/edit" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="md:flex md:items-center mb-6 w-full">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Title
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input class="inline-flex w-full h-10 px-3 border" name="title" :value="old('title', $post->title)" required />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Slug
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input class="inline-flex w-full h-10 px-3 border" name="slug" :value="old('slug', $post->slug)" required />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Excerpt
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea class="inline-flex w-full" name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</textarea>
                <x-form-error name="'excerpt'" />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Youtube link iframe
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input name="video_src" class="inline-flex w-full h-10 px-3" type="text" :value="old('video_src', $post->video_src)" required/>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Post Image
                </label>
            </div>
            <div class="md:w-1/3">
                <x-input name="thumbnail" class="inline-flex w-full" type="file" :value="old('thumbnail', $post->thumbnail)" />
            </div>
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Body
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea class="inline-flex w-full" name="body" required>{{ old('body', $post->body) }}</textarea>
                <x-form-error name="'body'" />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Category
                </label>
            </div>
            <div class="md:w-2/3">
                <select name="category_id" id="category_id" required class="inline-flex w-full rounded-md shadow-sm border-gray-300">
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form-error name="'category_id'" />
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <x-button>Update</x-button>
            </div>
        </div>

{{--            <div class="flex mt-6">--}}
{{--                <div class="flex-1">--}}
{{--                    <x-input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)" />--}}
{{--                </div>--}}

{{--                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">--}}
{{--            </div>--}}

    </form>
</x-app-layout>
<script src="https://cdn.tiny.cloud/1/{{ env("TINYMCE_API_KEY") }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        }
    });
</script>
