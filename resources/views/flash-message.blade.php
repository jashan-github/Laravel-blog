@if ($message = Session::get('success'))
    <div class="w-full fixed items-center justify-center">
        <div class="items-center w-80 relative mx-auto session-alert space-x-3 justify-between max-w-lg p-4 font-medium bg-white rounded-lg shadow-lg"
            id="alert" x-data="{ flashMessage: true }" x-show="flashMessage"
            x-init="setTimeout(() => flashMessage = false, 3000)">
            <div class="items-center text-center space-x-3 text-green-600">
                <p class="flex items-center gap-1">
                    {{ $message }}
                        <x-icon-close @click="flashMessage = false" class="text-gray-600 w-6 h-6 absolute right-2 cursor-pointer" />
                </p>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="flex items-center session-alert space-x-3 justify-between max-w-lg p-4 font-medium bg-white rounded-lg shadow-lg fixed z-20 right-6 top-20"
        id="alert" x-data="{ flashMessage: true }" x-show="flashMessage"
        x-init="setTimeout(() => flashMessage = false, 3000)">
        <div class="flex items-center space-x-3 text-red-600">
            <p class="flex items-center gap-1">
                {{ $message }}
                    <span class="mb-4 ml-4">
                        <x-icon-close @click="flashMessage = false" class="text-gray-600 w-6 h-6 absolute right-2 cursor-pointer" />
                    </span>
            </p>
        </div>
    </div>
@endif
