<form action="{{ route('templates.destroy', $template->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="p-6">
        <div class="mb-6">
            <div class="flex justify-center mb-4">
                <div class="h-12 w-12 flex items-center justify-center bg-red-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Confirm Template Deletion</h3>
            <p class="text-center text-gray-600">
                Are you sure you want to delete the template:
                <strong>{{ 'TMP' . sprintf('%04d', $template->id) }}</strong>?
            </p>
            <p class="text-center text-red-600 text-sm mt-4">
                This action cannot be undone.
            </p>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none text-white font-medium rounded-lg transition-colors flex items-center">
            Delete Template
        </button>
    </div>
</form>
