<x-app-layout>
    <x-slot name="header">
        <section class="flex sm:flex-row gap-3 justify-between items-center pt-4 mb-4 md:mb-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Blogs') }}
            </h2>
            <div>
                <a
                    href="{{ route('blogs.create') }}"
                    class="inline-block px-7 py-2 bg-blue-600 text-white font-medium text-base
                    leading-snug  rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg transition
                    ease-in-out w-full ripple-surface-light">
                    {{ __('Create Blog') }}
                </a>
            </div>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <label class="relative block lg:w-80">
                        <span class="sr-only">{{ __('Search') }}</span>
                        <span class="absolute inset-y-7 left-0 flex items-center pl-2 text-gray-300">
                            <x-icon-search />
                        </span>
                        <form class="mb-4 lg:mb-0" method="get" id="form_id">
                            <input
                                class="placeholder:text-gray-400 block bg-white w-full border
                                border-gray-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none
                                focus:border-blue-500 focus:ring-blue-500 focus:ring-1 sm:text-sm"
                                placeholder="Search ..."
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                            >
                            <a href="{{ route('blogs', ['search' => '']) }}&{{ http_build_query(request()->except('search')) }}"
                                class="absolute inset-y-5 right-0 flex items-center p-2 text-gray-300">
                                <x-icon-search-cross />
                            </a>
                        </form>
                    </label>
                    <form
                        action=""
                        method="get">
                        <div class="py-6">
                            <div class="rounded-lg">
                                <div class="relative overflow-x-auto sm:rounded-lg lg:mb-52">
                                    <table class="w-full text-sm lg:mb-52">
                                        <thead>
                                            <x-table.row>
                                                <x-table.head-cell class="w-[54px]"> {{ __('S.No.') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Name') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Content') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Tags') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Status') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Action') }} </x-table.head-cell>
                                            </x-table.row>
                                        </thead>
                                        <x-table.body>
                                            @forelse($blogs as $key => $blog)
                                                <x-table.row class="border-t border-b border-gray-100 odd:bg-violet-50/25">
                                                    <x-table.data-cell>{{ $key + $blogs->firstItem() }}</x-table.data-cell>
                                                    <x-table.data-cell>{{ $blog->title }}</x-table.data-cell>
                                                    <x-table.data-cell>
                                                        <p class="truncate max-w-sm" title="{{ $blog->content }}">
                                                            {{ $blog->content }}
                                                        </p>
                                                    </x-table.data-cell>
                                                    <x-table.data-cell>
                                                        @foreach ($blog->tags as $tag)
                                                            {{ $tag->name }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                    </x-table.data-cell>
                                                    <x-table.data-cell>
                                                        <label
                                                            class="inline-flex relative items-center cursor-pointer">
                                                            <input
                                                                type="checkbox"
                                                                name="status"
                                                                id="statusModal-{{$key}}"
                                                                data-url="{{ route('blogs.status', $blog) }}"
                                                                class="sr-only peer"
                                                                data-on="Active" data-off="InActive" {{ $blog->status ? 'checked' : '' }}
                                                                data-status={{ $blog->status }}
                                                                onchange="changeStatus(event)"
                                                            >
                                                            <div
                                                                class="w-11 h-6 bg-red-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300
                                                                rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-['']
                                                                after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border
                                                                after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                            </div>
                                                            <p class="ml-3">
                                                                {{ $blog->status ? 'Active' : 'Inactive' }}
                                                            </p>
                                                        </label>
                                                    </x-table.data-cell>
                                                    <x-table.data-cell>
                                                        <ul class="inline-flex gap-3 items-center">
                                                            <li>
                                                                <a
                                                                    href="{{ route('blogs.view', $blog) }}">
                                                                    <x-icon-view />
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="{{ route('blogs.edit', $blog) }}">
                                                                    <x-icon-edit />
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    id="deleteModal-{{$key}}"
                                                                    title="Delete"
                                                                    href="javascript:void(0);"
                                                                    data-url="{{ route('blogs.destroy', $blog) }}"
                                                                    onclick="remove(event)"
                                                                    class="block text-sm px-2 py-1 hover:bg-gray-100">
                                                                    <x-icon-trash />
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </x-table.data-cell>
                                                </x-table.row>
                                            @empty
                                                <x-table.row>
                                                    <x-table.row>
                                                        <x-table.data-cell colspan="9">
                                                            <div class="italic text-center text-2xl text-gray-300">{{ __('No Record found...') }}</div>
                                                        </x-table.data-cell>
                                                    </x-table.row>
                                                </x-table.row>
                                            @endforelse
                                        </x-table.body>
                                        <x-table.foot>
                                            <x-table.row>
                                                <x-table.data-cell colspan="9">
                                                    <div class="flex justify-between items-center space-x-6 text-gray-400">
                                                        <div class="space-x-4 flex-1">
                                                            {{ $blogs->links() }}
                                                        </div>
                                                    </div>
                                                </x-table.data-cell>
                                            </x-table.row>
                                        </x-table.foot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('modals')
    <!-- Delete Modal -->
    <x-confirmation-modal name="deleteModal">
        <x-slot name="title">{{ __('Delete Blog') }}</x-slot>
        <x-slot name="body">
            <!-- Body of the modal -->
            <x-slot name="icon">
                <div
                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12
                    rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <x-icon-error />
                </div>
            </x-slot>
            <form action="#" method="post" class="mb-0">
                @method('DELETE')
                @csrf
                <p class="text-sm text-gray-500 mt-4">
                    {{ __('Are you sure you want to delete? All of your data will be permanently removed.
                        This action cannot be undone.') }}
                </p>
                <div class="mt-6 flex justify-end text-sm space-x-4">
                    <a
                        href="javascript:void(0);"
                        @click="show = false"
                        class="btn justify-center rounded border border-gray-300
                            px-4 py-2 bg-white text-base font-medium text-gray-700">
                        {{ __('Cancel') }}
                    </a>
                    <button type="button" id="modalBtn" @click="formSubmit($event)"
                        class="btn px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                        {{ __('Delete') }}
                    </button>
                </div>
            </form>
        </x-slot>
    </x-confirmation-modal>

        <!-- Status Modal -->
        <x-confirmation-modal name="statusModal">
            <x-slot name="title">{{ __('Blog Status') }}</x-slot>
            <x-slot name="body">
                <!-- Body of the modal -->
                <x-slot name="icon" >
                    <div
                        id="activeIcon"
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12
                        rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <x-icon-activate-status />
                    </div>
                    <div
                        id="deactiveIcon"
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12
                        rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <x-icon-error />
                    </div>
                </x-slot>
                <form action="#" method="post" class="mb-0">
                    @csrf
                    <p class="text-sm text-gray-500 mt-4" id="activePara">
                        {{ __('Are you sure you want to Active the blog?') }}
                    </p>
                    <p class="text-sm text-gray-500 mt-4" id="deactivePara">
                        {{ __('Are you sure you want to Deactive the blog?') }}
                    </p>
                    <div class="mt-6 grid grid-cols-2 sm:flex sm:flex-row-reverse text-sm space-x-4 sm:space-x-reverse">
                        <button type="button" id="activeBtn" @click="formSubmit($event)"
                            class="btn px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">
                            {{ __('Activate Blog') }}
                        </button>
                        <button type="button" id="deactiveBtn" @click="formSubmit($event)"
                            class="btn px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">
                            {{ __('Deactivate Blog') }}
                        </button>
                        <a
                            href="javascript:void(0);"
                            @click="show = false;location.reload()"
                            class="inline-flex justify-center rounded border border-gray-300
                                px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700
                                shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300
                                focus:shadow-outline transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </x-slot>
        </x-confirmation-modal>
@endpush
@push('scripts')
    <script type="text/javascript">
        window.$modals = {
            show(name, id) {
                window.dispatchEvent(
                    new CustomEvent('modal', {
                        detail: name,
                        id: id
                    })
                );
            }
        }

        function formSubmit(e) {
            if (e.target.closest('form') != 'undefined') {
                e.target.closest('form').submit();
            }
        }

        // this function is used for open delete model.
        let remove = (e) => {
            const id = e.currentTarget.getAttribute('id');
                modal = id.split('-');
            if (modal.length === 2) {
                $modals.show(modal[0], id);
                document.querySelector(`#${modal[0]} form`).setAttribute('action', e.currentTarget.dataset.url);
            }
        }
        // this function is used for open status model.
        let changeStatus = (e) => {
            const id = e.currentTarget.getAttribute('id');
                modal = id.split('-');
            if (modal.length === 2) {
                $modals.show(modal[0], id);
                document.querySelector(`#${modal[0]} form`).setAttribute('action', e.currentTarget.dataset.url);
                if (e.currentTarget.dataset.status == 1){
                    document.getElementById('activeBtn').style.display = "none";
                    document.getElementById('activePara').style.display = "none";
                    document.getElementById('activeIcon').style.display = "none";
                } else {
                    document.getElementById('deactiveBtn').style.display = "none";
                    document.getElementById('deactivePara').style.display = "none";
                    document.getElementById('deactiveIcon').style.display = "none";
                }
            }
        }
    </script>
@endpush
</x-app-layout>