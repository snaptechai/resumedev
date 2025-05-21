<form action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="p-6 space-y-4">
        <div>
            <label for="identifier-new" class="block text-sm font-medium text-gray-700 mb-2">
                Identifier
            </label>
            <input type="text" name="identifier" id="identifier-new"
                class="w-full rounded-lg border-gray-300 py-3 px-4 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                placeholder="Enter unique identifier" required>
        </div>

        <div>
            <div class="flex items-center space-x-2 mb-2">
                <input type="checkbox" name="is_active" id="is_active-new"
                    class="rounded border-gray-300 text-[#BCEC88] focus:ring-[#BCEC88]" checked>
                <label for="is_active-new" class="text-sm font-medium text-gray-700">
                    Active
                </label>
            </div>
            <p class="text-sm text-gray-500">
                Active templates will be available for selection.
            </p>
        </div>

        <div>
            <label for="image-new" class="block text-sm font-medium text-gray-700 mb-2">
                Template Image
            </label>
            <input type="file" name="image" id="image-new"
                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-[#f0f9e8] file:text-[#6b8f3b] hover:file:bg-[#e8f5dd]"
                onchange="previewNewImage()" required>

            <div class="mt-3 hidden" id="new-image-preview-container">
                <img id="new-image-preview" src="" alt="Template Image"
                    class="max-h-40 object-contain rounded-lg shadow-md">
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
            Create Template
        </button>
    </div>
</form>

<script>
    function previewNewImage() {
        const input = document.getElementById('image-new');
        const preview = document.getElementById('new-image-preview');
        const container = document.getElementById('new-image-preview-container');

        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
