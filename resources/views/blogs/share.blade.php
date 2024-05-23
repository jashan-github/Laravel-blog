<x-app-layout>
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
                <form action="{{ route('blogs.send', $blog)}}" method="post">
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-8">
                            <div class="rounded-lg">
                                <div class="relative overflow-x-auto sm:rounded-lg mb-4">
                                    <p> {{ __('Add user\'s name and email for share the blog') }}</p>
                                    <x-form.input
                                        placeholder="Enter Name"
                                        id="recipient_name"
                                        type="text"
                                        name="recipient_name"
                                        label="{{ __('User Name') }}"
                                        required autofocus
                                    />
                                    <x-error name="name" />
                                    <x-form.input
                                        placeholder="Enter Email"
                                        id="recipient_email"
                                        type="text"
                                        name="recipient_email"
                                        label="{{ __('User Email') }}"
                                        required autofocus
                                    />
                                    <x-error name="Email" />
                                </div>
                                    <button type="submit"
                                    class="btn px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                                    {{ __('Share') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>