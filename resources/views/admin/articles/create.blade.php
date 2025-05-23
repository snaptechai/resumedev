<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Create New Article</h2>
            </div>

            @include('admin.massage-bar')

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6"
                x-data="{
                    selectedCategory: '{{ old('category') }}',
                    filteredSubcategories: []
                }" x-init="filteredSubcategories = selectedCategory ?
                    {{ $subcategories->toJson() }}.filter(sc => sc.category == selectedCategory) : [];">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4 bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Basic Information
                        </h3>

                        <div>
                            <label for="article_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Article Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="article_title" name="article_title"
                                value="{{ old('article_title') }}" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter article title">
                        </div>

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                                URL Title <span class="text-red-500">*</span>
                                <span class="text-xs text-gray-500 font-normal">(spaces will be replaced with dashes in
                                    the URL)</span>
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter URL title">
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">
                                Category <span class="text-red-500">*</span>
                            </label>
                            <select id="category" name="category" required x-model="selectedCategory"
                                @change="
                                    filteredSubcategories = {{ $subcategories->toJson() }}.filter(sc => sc.category == selectedCategory);
                                "
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="sub_category" class="block text-sm font-medium text-gray-700 mb-1">
                                Sub Category
                            </label>
                            <select id="sub_category" name="sub_category"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                                <option value="">Select a sub category</option>
                                <template x-for="subcategory in filteredSubcategories" :key="subcategory.id">
                                    <option :value="subcategory.id"
                                        :selected="subcategory.id == {{ old('sub_category', 0) }}"
                                        x-text="subcategory.sub_category"></option>
                                </template>
                            </select>
                        </div>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" id="featured" name="featured" value="1"
                                {{ old('featured') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-[#BCEC88] focus:ring-[#BCEC88]">
                            <label for="featured" class="ml-2 text-sm text-gray-700">Feature this article</label>
                        </div>

                        <div>
                            <label for="added_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Publication Date
                            </label>
                            <input type="date" id="added_date" name="added_date"
                                value="{{ old('added_date', date('Y-m-d')) }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                Featured Image <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" required
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-[#f0f9e8] file:text-[#6b8f3b] hover:file:bg-[#e8f5dd]">
                        </div>
                    </div>

                    <div class="space-y-4 bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">SEO Information</h3>

                        <div>
                            <label for="seo_article_title" class="block text-sm font-medium text-gray-700 mb-1">
                                SEO Title
                            </label>
                            <input type="text" id="seo_article_title" name="seo_article_title"
                                value="{{ old('seo_article_title') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter SEO title">
                        </div>

                        <div>
                            <label for="seo_description" class="block text-sm font-medium text-gray-700 mb-1">
                                SEO Description
                            </label>
                            <textarea id="seo_description" name="seo_description" rows="3"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter SEO description">{{ old('seo_description') }}</textarea>
                        </div>

                        <div>
                            <label for="seo_keywords" class="block text-sm font-medium text-gray-700 mb-1">
                                SEO Keywords
                            </label>
                            <input type="text" id="seo_keywords" name="seo_keywords"
                                value="{{ old('seo_keywords') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter keywords separated by commas">
                        </div>

                        <div>
                            <label for="og_title" class="block text-sm font-medium text-gray-700 mb-1">
                                OG Title
                            </label>
                            <input type="text" id="og_title" name="og_title" value="{{ old('og_title') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter OG title">
                        </div>

                        <div>
                            <label for="og_description" class="block text-sm font-medium text-gray-700 mb-1">
                                OG Description
                            </label>
                            <textarea id="og_description" name="og_description" rows="3"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter OG description">{{ old('og_description') }}</textarea>
                        </div>

                        <div>
                            <label for="img_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Image Title
                            </label>
                            <input type="text" id="img_title" name="img_title" value="{{ old('img_title') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter image title">
                        </div>

                        <div>
                            <label for="img_alt" class="block text-sm font-medium text-gray-700 mb-1">
                                Image Alt Text
                            </label>
                            <input type="text" id="img_alt" name="img_alt" value="{{ old('img_alt') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter image alt text">
                        </div>

                        <div>
                            <label for="img_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Image Description
                            </label>
                            <textarea id="img_description" name="img_description" rows="2"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter image description">{{ old('img_description') }}</textarea>
                        </div>

                        <div>
                            <label for="schema_code" class="block text-sm font-medium text-gray-700 mb-1">
                                Schema Code
                            </label>
                            <textarea id="schema_code" name="schema_code" rows="3"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter schema code">{{ old('schema_code') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-5 rounded-lg mt-6">
                    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2 mb-4">Article Content
                    </h3>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                        <trix-editor input="description"
                            class="trix-content min-h-[400px] prose max-w-none bg-white rounded-lg border border-gray-300"></trix-editor>
                    </div>
                </div>

                <div class="flex items-center justify-end border-t border-gray-200 pt-5 mt-6">
                    <button type="button" onclick="window.location='{{ route('articles.index') }}'"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit"
                        class="ml-3 px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                        Create Article
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
