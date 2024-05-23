<x-app-layout>
    <x-slot name="header">
        <section class="flex  sm:flex-row gap-3 justify-between items-center pt-4 mb-4 md:mb-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Blogs') }}
            </h2>
        </section>
    </x-slot>

    <article id="getHeight" class="px-4 sm:px-8 pt-6 pb-10">
        <section class="flex sm:flex-row gap-3 xl:w-2/3 m-auto w-full justify-between items-center pt-4 md:mb-2">
            <h2 class="mb-2 font-semibold md:text-lg items-center text-gray-800 leading-tight flex gap-3">
                <a href="{{ route('blogs') }}">
                    <x-icon-back-arrow />
                </a>
                {{ $blog->title}} {{ __('- Comments') }}
            </h2>
            <div>
                <a
                    href="{{ route('blogs.share', $blog) }}"
                    class="inline-block px-7 py-2 bg-blue-600 text-white font-medium text-base
                    leading-snug  rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg transition
                    ease-in-out w-full ripple-surface-light">
                    {{ __('Share Blog') }}
                </a>
            </div>
        </section>
        <div class="bg-white xl:w-2/3 m-auto w-full rounded-lg p-6">
            <div class="gap-2 ">
                <div class="justify-between gap-4">
                    <div class="flex">
                        <div class="text-gray-400"> {{ __('Title:') }}</div>
                        <div class="ml-2">{{ $blog->title }}</div>
                    </div>
                </div>
                <div class="justify-between gap-4 mt-3">
                        <div class="text-gray-400"> {{ __('Content:') }}</div>
                        <div class="ml-4">{{ $blog->content }}</div>
                    </div>
                </div>
            </div>

        <div class="py-8">
                <form action="{{ route('comments.store', $blog)}}"
                    method="post">
                    @csrf
                    <div class="bg-white xl:w-2/3 m-auto w-full rounded-lg p-6">
                        <div class="gap-2 ">
                            <div class="w-full">
                                <x-label class="font-semibold" for="comment" :value="__('Enter Comments')" />
                                <textarea
                                    id="name"
                                    rows="3"
                                    name="name"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded border
                                    border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                ></textarea>
                            </div>
                            <x-error name="comment" />
                            <div class="gap-2 flex mt-6">
                                <a href="{{ route('blogs') }}"
                                    class="px-7 mb-4 py-3 bg-white text-black font-medium text-sm leading-snug border
                                    rounded ripple-surface-light">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit"
                                    class="px-7 mb-4 py-3 bg-gray-600 text-white font-medium text-sm leading-snug
                                    rounded shadow-md  hover:shadow-lg ripple-surface-light">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            <div class="bg-white xl:w-2/3 m-auto w-full rounded-lg p-6 mt-9">
                @forelse($blog->comments as $comment)
                    <div class="shadow-sm p-3 text-sm leading-6 rounded border mb-4">
                        <p>
                            {{ $comment->name }}
                        </p>
                        <div class="flex justify-between gap-4 mt-3">
                            <div class="flex">
                                <div class="text-gray-400"> {{ __('Posted by:') }}</div>
                                <div class="ml-2">{{ $comment->user->name }}</div>
                            </div>
                            <div class="flex">
                                <div class="text-gray-400">{{ __('Date:') }}</div>
                                <div class="ml-2"> {{ $comment->created_at->format('d M, Y') }}</div>
                            </div>
                        </div>
                        <form id="likeForm" action="{{ route('comments.like', $comment) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link">
                                @if($comment->likes->count() > 0)
                                    Unlike
                                @else
                                    Like
                                @endif
                                ({{ $comment->likes->count() }})
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="flex justify-between items-center space-x-6 text-gray-400">
                        <div class="flex text-2xl italic space-x-4 flex-1">
                            {{ __('No Record found...') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </article>
</x-app-layout>