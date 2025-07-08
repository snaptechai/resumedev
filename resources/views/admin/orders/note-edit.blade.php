<form action="{{ route('orders.update-admin-note', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2 h-full">
                <div class="h-full">
                    <label for="admin_note" class="block text-sm font-medium text-gray-700 mb-2">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea id="tinymce-editor" name="admin_note" class="tinymce-editor">{{ old('admin_note', $order->admin_note) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#000000] font-medium rounded-lg transition-colors">
            Update Admin Note
        </button>
    </div>
</form>
