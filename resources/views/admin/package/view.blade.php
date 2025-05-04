<div id="view-{{ $package->id }}" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all">
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                View Package
            </h3>
            <button type="button" onclick="closeModal('view-{{ $package->id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @php
                    $fields = [
                        'Title' => $package->title,
                        'Price (LKR)' => number_format($package->price, 2),
                        'Duration' => $package->duration,
                        'Europe Price (€)' => number_format($package->europe_price, 2),
                        'Old Price (LKR)' => number_format($package->old_price, 2),
                        'Europe Old Price (€)' => number_format($package->europe_old_price, 2),
                    ];
                @endphp

                @foreach ($fields as $label => $value)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ $label }}
                        </label>
                        <div class="p-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white shadow-sm">
                            {{ $value }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-6">
                <label for="short_description" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Short Description
                </label>
                <input 
                    id="short_description_{{ $package->id }}" 
                    type="hidden" 
                    name="short_description" 
                    value="{{ $package->short_description }}">
                <trix-editor 
                    input="short_description_{{ $package->id }}" 
                    class="trix-content border border-gray-300 dark:border-gray-600 rounded-md p-3 dark:bg-gray-800 dark:text-gray-100 pointer-events-none" 
                    contenteditable="false"></trix-editor>
            </div>

            <div class="mb-6">
                <label for="full_description" class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-2">
                    Full Description
                </label>
                <input 
                    id="full_description_{{ $package->id }}" 
                    type="hidden" 
                    name="full_description" 
                    value="{{ $package->full_description }}">
                <trix-editor 
                    input="full_description_{{ $package->id }}" 
                    class="trix-content border border-gray-300 dark:border-gray-600 rounded-md p-3 dark:bg-gray-800 dark:text-gray-100 pointer-events-none" 
                    contenteditable="false"></trix-editor>
            </div>
           
        </div>

        <div class="flex items-center justify-end p-5 border-t dark:border-gray-700">
            <button type="button" onclick="closeModal('view-{{ $package->id }}')" class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                Close
            </button>
        </div>
    </div>
</div>
