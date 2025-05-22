<form action="{{ route('article-categories.store') }}" method="POST" x-data="{ subcategories: [{ value: '' }] }">
    @csrf
    <div class="p-6 space-y-4">
        <div>
            <label for="create-category" class="block text-sm font-medium text-gray-700 mb-2">
                Category Name
            </label>
            <input type="text" id="create-category" name="category" value="{{ old('category') }}" required
                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Sub Categories
            </label>
            <div class="space-y-2 max-h-60 overflow-y-auto border border-gray-300 p-4 rounded-lg">
                <template x-for="(subcategory, index) in subcategories" :key="index">
                    <div class="flex gap-2 items-center mb-2">
                        <input type="text" :name="`subcategories[${index}]`" x-model="subcategory.value"
                            class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                            placeholder="Sub-category name">
                        <button type="button" @click="subcategories.splice(index, 1)" x-show="subcategories.length > 1"
                            class="p-2 text-red-600 hover:text-red-800 focus:outline-none">
                            <x-icon name="trash" class="w-4 h-4" />
                        </button>
                    </div>
                </template>
            </div>
            <button type="button" @click="subcategories.push({ value: '' })"
                class="mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-[#5D7B2B] border border-[#BCEC88] rounded-lg hover:bg-[#BCEC88]/20 transition-colors">
                <x-icon name="plus" class="w-4 h-4 mr-1.5" />
                Add Sub-category
            </button>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
            Create Category
        </button>
    </div>
</form>
