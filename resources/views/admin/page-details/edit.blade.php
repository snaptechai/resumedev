<form action="{{ route('page-details.update', $pageDetail->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Content for: <span class="font-semibold">{{ $pageDetail->type }}</span>
            </label>
            <input type="hidden" name="type" value="{{ $pageDetail->type }}">
            <div class="mt-1 rounded-lg border border-gray-300 overflow-hidden">
                <textarea id="tinymce-editor" name="content" class="tinymce-editor">{{ old('content', $pageDetail->content) }}</textarea>
            </div>
            <p class="mt-2 text-sm text-gray-500">
                Edit the content that will appear on the website.
            </p>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
            Update Content
        </button>
    </div>
</form>
