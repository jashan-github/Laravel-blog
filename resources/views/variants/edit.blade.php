<x-app-layout>
    <x-slot name="header">
        <section class="flex  sm:flex-row gap-3 justify-between items-center pt-4 mb-4 md:mb-0">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Variants') }}
            </h2>
        </section>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form id="editVariantForm">
                    @csrf
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-8">
                            <div class="rounded-lg">
                                <div class="relative overflow-x-auto sm:rounded-lg mb-4" id="variantList">
                                    <x-form.input
                                        placeholder="Enter Name"
                                        id="name"
                                        type="text"
                                        name="name"
                                        label="{{ __('Name') }}"
                                        :value="$variant->name"
                                        required autofocus
                                    />
                                    <span id="nameError" class="error-text"></span>
                                    <x-form.input
                                        placeholder="Enter Price"
                                        id="price"
                                        type="text"
                                        name="price"
                                        label="{{ __('Price') }}"
                                        :value="$variant->price"
                                        required autofocus
                                    />
                                    <span id="priceError" class="error-text"></span>
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script>
            $(document).ready(function() {
            $('#editVariantForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('variants.update', $variant) }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert('Variant updated successfully!');
                        window.location.href = '{{ route("variants") }}';
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            if (errors.name) {
                                $('#nameError').text(errors.name[0]);
                            }
                            if (errors.description) {
                                $('#descriptionError').text(errors.description[0]);
                            }
                            if (errors.price) {
                                $('#priceError').text(errors.price[0]);
                            }
                        } else {
                            alert('Error updating variant');
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>