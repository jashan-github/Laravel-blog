<x-app-layout>
    <x-slot name="header">
        <section class="flex  sm:flex-row gap-3 justify-between items-center pt-4 mb-4 md:mb-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Variants') }}
            </h2>
            <div>
                <a
                    href="{{ route('variants.create') }}"
                    class="inline-block px-7 py-2 bg-blue-600 text-white font-medium text-base
                    leading-snug  rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                    active:bg-blue-800 active:shadow-lg transition
                    ease-in-out w-full ripple-surface-light">
                    {{ __('Create Variants') }}
                </a>
            </div>
        </section>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form
                        action=""
                        id="exportForm"
                        method="get">
                        <div class="flex gap-4 items-center lg:mr-4">
                            <button
                                type="button"
                                onclick="exportData('csv')"
                                class="inline-block px-7 py-2 bg-blue-600 text-white font-medium text-base
                                leading-snug  rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                                focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                active:bg-blue-800 active:shadow-lg transition
                                ease-in-out ripple-surface-light">
                                {{ __('CSV Export') }}
                            </button>
                                <button
                                    type="button"
                                    onclick="exportData('pdf')"
                                    class="inline-block px-7 py-2 bg-blue-600 text-white font-medium text-base
                                    leading-snug  rounded shadow-md hover:bg-blue-700 hover:shadow-lg
                                    focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                                    active:bg-blue-800 active:shadow-lg transition
                                    ease-in-out ripple-surface-light">
                                    {{ __('PDF Export')}}
                                </button>
                        </div>
                        <div class="py-6">
                            <div class="rounded-lg">
                                <div class="relative overflow-x-auto sm:rounded-lg lg:mb-52">
                                    <table class="w-full text-sm lg:mb-52">
                                        <thead>
                                            <x-table.row>
                                                <x-table.head-cell> {{ __('Select') }} </x-table.head-cell>
                                                <x-table.head-cell class="w-[54px]"> {{ __('S.No.') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Product Name') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Name') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Price') }} </x-table.head-cell>
                                                <x-table.head-cell> {{ __('Action') }} </x-table.head-cell>
                                            </x-table.row>
                                        </thead>
                                        <x-table.body>
                                            @forelse($variants as $key => $variant)
                                                <x-table.row class="border-t border-b border-gray-100 odd:bg-violet-50/25">
                                                    <x-table.data-cell>
                                                        <input type="checkbox" name="variant_ids[]" value="{{ $variant->id }}">
                                                    </x-table.data-cell>
                                                    <x-table.data-cell>{{ $key + $variants->firstItem() }}</x-table.data-cell>
                                                    <x-table.data-cell>{{ $variant->product->name }}</x-table.data-cell>
                                                    <x-table.data-cell>{{ $variant->name }}</x-table.data-cell>
                                                    <x-table.data-cell>{{ number_format($variant->price, 2) }}</x-table.data-cell>
                                                    <x-table.data-cell>
                                                        <ul class="inline-flex gap-3 items-center">
                                                            <li>
                                                                <a
                                                                    href="{{ route('variants.edit', $variant) }}">
                                                                    <x-icon-edit />
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    id="deleteModal-{{$key}}"
                                                                    title="Delete"
                                                                    href="javascript:void(0);"
                                                                    data-url="{{ route('variants.destroy', $variant) }}"
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
                                                            {{ $variants->links() }}
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
        <x-slot name="title">{{ __('Delete Variant') }}</x-slot>
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

        function exportData(format) {
            const form = document.getElementById('exportForm');
            if (format === 'csv') {
                form.action = "{{ route('variants.exportCsv') }}";
            } else if (format === 'pdf') {
                form.action = "{{ route('variants.exportPdf') }}";
            }
            form.submit();
        }
    </script>
@endpush
</x-app-layout>