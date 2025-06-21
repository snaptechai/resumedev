<x-layouts.app>
    <div class="w-full py-5 px-6">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">View Article Details</h1>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8"> 
                <div class="space-y-5">
                    <div>
                        <p class="text-gray-500 text-sm">Article Title</p>
                        <p class="text-lg text-gray-800 font-medium">{{ $article->article_title }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">URL Title</p>
                        <p class="text-gray-800">{{ $article->title }}</p>
                    </div>
                    
                    <div>
                        <p class="text-gray-500 text-sm">Article Tag</p>
                        <p class="text-gray-800">
                           {{ isset($article_tag) ? $article_tag->tagTable->tag : 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Category</p>
                        <p class="text-gray-800">
                            {{ $article->articleCategory->category ?? 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Sub Category</p>
                        <p class="text-gray-800">
                            {{ $article->articleSubCategory->sub_category ?? 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Featured</p>
                        <p class="text-gray-800">
                            {{ $article->featured === 'yes' ? 'Yes' : 'No' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Publication Date</p>
                        <p class="text-gray-800">
                            {{ \Carbon\Carbon::parse($article->added_date)->format('F j, Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Featured Image</p>
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-64 rounded-md border mt-2">
                            <p class="text-sm text-gray-500 mt-1">Title: {{ $article->img_title }}</p>
                            <p class="text-sm text-gray-500">Alt: {{ $article->img_alt }}</p>
                            <p class="text-sm text-gray-500">Description: {{ $article->img_description }}</p>
                        @else
                            <p class="text-gray-800">No image uploaded</p>
                        @endif
                    </div>
                </div>
 
                <div class="space-y-5">
                    <div>
                        <p class="text-gray-500 text-sm">SEO Title</p>
                        <p class="text-gray-800">{{ $article->seo_article_title }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">SEO Description</p>
                        <p class="text-gray-800">{{ $article->seo_description }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">SEO Keywords</p>
                        <p class="text-gray-800">{{ $article->seo_keywords }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">OG Title</p>
                        <p class="text-gray-800">{{ $article->og_title }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">OG Description</p>
                        <p class="text-gray-800">{{ $article->og_description }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">Schema Code</p>
                        <pre class="bg-gray-100 text-sm p-3 rounded border overflow-x-auto text-gray-700">{{ $article->schema_code }}</pre>
                    </div>
                </div>
            </div>
 
            <div class="mt-10">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Article Content</h2>
                <div class="prose max-w-none prose-green">
                    <textarea id="tinymce-editor" name="description" class="tinymce-editor w-full" readonly>{{ old('description', $article->description) }}</textarea>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('articles.edit', $article->id) }}"
                   class="inline-block bg-[#BCEC88] hover:bg-[#a5da70] text-[#4f6828] font-medium py-2 px-4 rounded-lg transition-colors mr-2">
                    Edit Article
                </a>
                <a href="{{ route('articles.index') }}"
                   class="inline-block text-gray-600 hover:text-gray-800 font-medium py-2 px-4 border border-gray-300 rounded-lg">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
