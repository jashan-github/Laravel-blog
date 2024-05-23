<x-app-layout>
    @php
        $tagIds = $blog->tags->pluck('id');
    @endphp
    <x-slot name="header">
        <section class="flex  sm:flex-row gap-3 justify-between items-center pt-4 mb-4 md:mb-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Blogs') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('blogs.update', $blog)}}" method="post">
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-8">
                            <div class="rounded-lg">
                                <div class="relative overflow-x-auto sm:rounded-lg mb-4">
                                    <x-form.input
                                        placeholder="Enter Title"
                                        id="title"
                                        type="text"
                                        name="title"
                                        label="{{ __('Title') }}"
                                        :value="$blog->title"
                                        required autofocus
                                    />
                                    <x-error name="title" />
                                    <x-form.input
                                        placeholder="Enter Content"
                                        id="content"
                                        type="text"
                                        name="content"
                                        label="{{ __('Content') }}"
                                        :value="$blog->content"
                                        required autofocus
                                    />
                                    <x-error name="content" />
                                    <label
                                        class="mt-2 block mb-2 text-sm font-semibold text-gray-900"
                                        for="tags">
                                        {{ __('Tags') }}
                                    </label>
                                    <select name="tagIds[]" id="tags" class="form-control ml-8" multiple required>
                                        @foreach ($tags as $tag)
                                            <option {{ $tagIds->contains($tag->id) ? 'selected' : '' }}
                                                value="{{ $tag['id'] }}">
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="btn px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>