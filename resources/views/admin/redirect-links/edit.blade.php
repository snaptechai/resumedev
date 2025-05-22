<form action="{{ route('redirect-links.update', $val->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="original_url-{{ $val->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Original Url
                </label>
                <input type="text" name="original_url" id="original_url-{{ $val->id }}"
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Enter original url..." value="{{ $val->original_url }}">
            </div>

            <div class="md:col-span-2">
                <label for="new_url-{{ $val->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    New Url
                </label>
                <input type="text" name="new_url" id="new_url-{{ $val->id }}"
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Enter New Url code..." value="{{ $val->new_url }}">
            </div>
            <div class="md:col-span-2">
                <label for="note-{{ $val->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Note
                </label>
                <textarea name="note" id="note-{{ $val->id }}" rows="3"
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Add a description or note here...">{{ $val->note }}</textarea>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
            Update Link
        </button>
    </div>
</form>
