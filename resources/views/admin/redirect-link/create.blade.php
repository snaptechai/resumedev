<div id="create-link" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all">
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Create New Redirect Link
            </h3>
            <button type="button" onclick="closeModal('create-link')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <form action="{{ route('redirectlink.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Original URL -->
                    <div class="md:col-span-2">
                        <label for="original_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Original URL
                        </label>
                        <input 
                            type="url"
                            name="original_url"
                            id="original_url"
                            placeholder="https://example.com"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3"
                        >
                    </div>

                    <!-- New URL -->
                    <div class="md:col-span-2">
                        <label for="new_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Redirect To (New URL)
                        </label>
                        <input 
                            type="url"
                            name="new_url"
                            id="new_url"
                            placeholder="https://new-destination.com"
                            required
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3"
                        >
                    </div>

                    <!-- Note -->
                    <div class="md:col-span-2">
                        <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Note
                        </label>
                        <textarea 
                            name="note"
                            id="note"
                            rows="3"
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3"
                            placeholder="Add a description or note here..."
                        ></textarea>
                    </div> 
                </div>
            </div>

            <div class="flex items-center justify-end p-5 border-t dark:border-gray-700 gap-3">
                <button 
                    type="button" 
                    onclick="closeModal('create-link')" 
                    class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2.5 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 focus:outline-none text-white font-medium rounded-lg transition-colors"
                >
                    Save Link
                </button>
            </div>
        </form>
    </div>
</div>
