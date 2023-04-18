<x-app-layout>

    <div class="md:flex md:items-center mb-6 w-full">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <h2 class="text-3xl">Create Post</h2>
        </div>
    </div>
    <form class="w-full" method="POST" action="/admin/posts/new" enctype="multipart/form-data">
        @csrf

        <div class="md:flex md:items-center mb-6 w-full">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Title
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input class="border inline-flex w-full h-10 px-3" name="title" :value="old('title', request('title'))" required />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Slug
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input class="border inline-flex w-full h-10 px-3" name="slug" :value="old('slug', request('slug'))" required />
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Excerpt
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea class="inline-flex w-full" name="excerpt" required>{{ old('excerpt', request('exceprt')) }}</textarea>
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
                <x-input name="video_src" class="inline-flex w-full h-10 px-3" type="text" :value="old('video_src', request('video_src'))" required/>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Post Image
                </label>
            </div>
            <div class="md:w-2/3">
                <x-input name="thumbnail" class="inline-flex w-full" type="file" :value="old('thumbnail', request('thumbnail'))" required/>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                    Body
                </label>
            </div>
            <div class="md:w-2/3">
                <textarea class="inline-flex w-full" name="body" required>{{ old('body', request('body')) }}</textarea>
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
                            {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form-error name="'category_id'" />
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <x-button class="h-10">Create</x-button>
            </div>
        </div>

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
