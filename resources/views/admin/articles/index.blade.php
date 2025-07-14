<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Articles</h2>

                <div class="flex items-center gap-3">
                    <form method="GET" action="{{ route('articles.index') }}" class="flex items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <x-icon name="magnifying-glass" class="h-4 w-4 text-gray-400" />
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="block w-96 pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#BCEC88] focus:border-[#BCEC88] transition-colors"
                                placeholder="Search articles...">
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                            Search
                        </button>

                        @if (request('search'))
                            <a href="{{ route('articles.index') }}"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BCEC88]/30 transition-colors">
                                <x-icon name="x-mark" class="h-4 w-4 mr-1" />
                                Clear
                            </a>
                        @endif
                    </form>

                    <a href="{{ route('articles.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                        <x-icon name="plus" class="w-4 h-4 mr-1.5" />
                        Add Article
                    </a>
                </div>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Article #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Title</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Category</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Sub Category</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Featured</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Date Added</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $article->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-gray-600">{{ Str::limit($article->article_title, 50) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $article->category_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ $article->sub_category_name ?? 'None' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($article->featured)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Featured
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Not Featured
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($article->added_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="https://www.resumemansion.com/article/{{ urlencode(str_replace(' ', '-', $article->title)) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-green-700 hover:text-[#71ef84] hover:underline" target="_blank">
                                            <x-icon name="arrow-top-right-on-square" class="w-4 h-4 mr-1" />
                                            Preview
                                        </a>
                                        <a href="{{ route('articles.show', $article->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-green-700 hover:text-[#71ef84] hover:underline">
                                            <x-icon name="eye" class="w-4 h-4 mr-1" />
                                            View
                                        </a>
                                        <a href="{{ route('articles.edit', $article->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                            Edit
                                        </a>

                                        <x-modal id="delete-article-{{ $article->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                    <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                    Delete
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Delete Article</h3>
                                            </x-slot>

                                            <div>
                                                @include('admin.articles.delete', [
                                                    'article' => $article,
                                                ])
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="document-text" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No articles found</h3>
                                        <p class="text-sm text-gray-500">
                                            @if (request('search'))
                                                No articles match your search criteria.
                                            @else
                                                There are no articles matching your criteria.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $articles->appends(['search' => $search])->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
