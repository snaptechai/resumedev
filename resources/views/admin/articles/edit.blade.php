<x-layouts.app>
    <div class="flex flex-col">
        <div class="flex flex-col gap-2">
            <x-typography.heading accent size="xl" level="1">
                Edit Article
            </x-typography.heading>
            <x-typography.subheading size="lg">
                Update article information.
            </x-typography.subheading>
            <x-separator class="my-4" />
        </div>
    </div>

    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data"
        class="space-y-6" x-data="{
            selectedCategory: '{{ old('category', $article->category) }}',
            filteredSubcategories: []
        }" x-init="filteredSubcategories = selectedCategory ?
            {{ $subcategories->toJson() }}.filter(sc => sc.category == selectedCategory) : [];">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Basic Information</h2>

                <div class="space-y-4">
                    <div>
                        <label for="article_title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Article Title *
                        </label>
                        <input type="text" id="article_title" name="article_title"
                            value="{{ old('article_title', $article->article_title) }}" required
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter article title">
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            URL Title * <span class="text-xs text-gray-500">(All spaces will be replaced with dashes (-)
                                in the URL)</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}"
                            required
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter URL title">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Category *
                        </label>
                        <select id="category" name="category" required x-model="selectedCategory"
                            @change="
                                filteredSubcategories = {{ $subcategories->toJson() }}.filter(sc => sc.category == selectedCategory);
                            "
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category', $article->category) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="sub_category"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Sub Category
                        </label>
                        <select id="sub_category" name="sub_category"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                            <option value="">Select a sub category</option>
                            <template x-for="subcategory in filteredSubcategories" :key="subcategory.id">
                                <option :value="subcategory.id"
                                    :selected="subcategory.id == {{ old('sub_category', $article->sub_category ?: 0) }}"
                                    x-text="subcategory.sub_category"></option>
                            </template>
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="featured" name="featured" value="1"
                            {{ old('featured', $article->featured) ? 'checked' : '' }}
                            class="rounded-radius border border-outline bg-surface text-primary focus:ring-primary dark:border-outline-dark dark:bg-surface-dark dark:text-primary-dark">
                        <label for="featured" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Feature this article
                        </label>
                    </div>

                    <div>
                        <label for="added_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Publication Date
                        </label>
                        <input type="date" id="added_date" name="added_date"
                            value="{{ old('added_date', $article->added_date ? date('Y-m-d', strtotime($article->added_date)) : date('Y-m-d')) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Featured Image
                        </label>
                        @if ($article->image)
                            <div class="mb-2">
                                <img src="{{ asset($article->image) }}" alt="Current featured image"
                                    class="h-32 w-auto object-cover rounded">
                                <p class="text-xs text-gray-500 mt-1">Current image: {{ basename($article->image) }}
                                </p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep the current image</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">SEO Information</h2>

                <div class="space-y-4">
                    <div>
                        <label for="seo_article_title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            SEO Title
                        </label>
                        <input type="text" id="seo_article_title" name="seo_article_title"
                            value="{{ old('seo_article_title', $article->seo_article_title) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter SEO title">
                    </div>

                    <div>
                        <label for="seo_description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            SEO Description
                        </label>
                        <textarea id="seo_description" name="seo_description" rows="3"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter SEO description">{{ old('seo_description', $article->seo_description) }}</textarea>
                    </div>

                    <div>
                        <label for="seo_keywords"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            SEO Keywords
                        </label>
                        <input type="text" id="seo_keywords" name="seo_keywords"
                            value="{{ old('seo_keywords', $article->seo_keywords) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter keywords separated by commas">
                    </div>

                    <div>
                        <label for="og_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            OG Title
                        </label>
                        <input type="text" id="og_title" name="og_title"
                            value="{{ old('og_title', $article->og_title) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter OG title">
                    </div>

                    <div>
                        <label for="og_description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            OG Description
                        </label>
                        <textarea id="og_description" name="og_description" rows="3"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter OG description">{{ old('og_description', $article->og_description) }}</textarea>
                    </div>

                    <div>
                        <label for="img_title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Image Title
                        </label>
                        <input type="text" id="img_title" name="img_title"
                            value="{{ old('img_title', $article->img_title) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter image title">
                    </div>

                    <div>
                        <label for="img_alt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Image Alt Text
                        </label>
                        <input type="text" id="img_alt" name="img_alt"
                            value="{{ old('img_alt', $article->img_alt) }}"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter image alt text">
                    </div>

                    <div>
                        <label for="img_description"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Image Description
                        </label>
                        <textarea id="img_description" name="img_description" rows="2"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter image description">{{ old('img_description', $article->img_description) }}</textarea>
                    </div>

                    <div>
                        <label for="schema_code"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Schema Code
                        </label>
                        <textarea id="schema_code" name="schema_code" rows="3"
                            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark"
                            placeholder="Enter schema code">{{ old('schema_code', $article->schema_code) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Article Content</h2>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Content *
                </label>
                <input id="description" type="hidden" name="description"
                    value="{{ old('description', $article->description) }}">
                <trix-editor input="description" class="trix-content min-h-[400px]"></trix-editor>
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('articles.index') }}"
                class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
                Cancel
            </a>
            <button type="submit"
                class="px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-primary rounded-radius cursor-pointer">
                Update Article
            </button>
        </div>
    </form>
</x-layouts.app>
