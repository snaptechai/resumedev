<form action="{{ route('article-categories.store') }}" method="POST" x-data="{ subcategories: [{ value: '' }] }">
    @csrf
    <div class="pb-4">
        <label for="create-category" class="block mb-1 text-sm font-medium">Category Name</label>
        <input type="text" id="create-category" name="category" required
            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
    </div>

    <div class="pb-4">
        <label class="block mb-1 text-sm font-medium">Sub-Categories</label>
        <div class="space-y-2">
            <template x-for="(subcategory, index) in subcategories" :key="index">
                <div class="flex gap-2 items-center">
                    <input type="text" :name="`subcategories[${index}]`" x-model="subcategory.value"
                        class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                        placeholder="Sub-category name">
                    <button type="button" class="text-danger" @click="subcategories.splice(index, 1)"
                        x-show="subcategories.length > 1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </template>
        </div>
        <button type="button" @click="subcategories.push({ value: '' })"
            class="mt-2 inline-flex items-center gap-1 px-3 py-1 text-xs font-medium text-primary border border-primary rounded-radius hover:bg-primary hover:text-white transition-colors">
            <span>+ Add Sub-category</span>
        </button>
    </div>

    <div class="flex justify-end gap-2 mt-4">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-primary rounded-radius cursor-pointer">
            Save
        </button>
    </div>
</form>
