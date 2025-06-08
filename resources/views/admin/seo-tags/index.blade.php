<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">SEO (Meta) Details</h2>
                <a href="{{ route('seo-tags.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                    <x-icon name="plus" class="w-4 h-4 mr-1.5" />
                    Add SEO Detail
                </a>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Tag #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Page Name</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                URL</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Meta Title</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 max-w-[200px] truncate">
                                Meta Description</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 max-w-[200px] truncate">
                                Meta Keywords</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200 max-w-[200px] truncate">
                                Javascript Code
                            </th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Is Active</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($metatags as $metatag)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm  text-gray-900">{{ $metatag->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $metatag->page_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm  text-gray-900">{{ $metatag->url }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $metatag->meta_title }}</span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-[200px] truncate overflow-hidden text-ellipsis">
                                    <span
                                        class="text-sm text-gray-900 truncate block">{{ $metatag->meta_description }}</span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-[200px] truncate overflow-hidden text-ellipsis">
                                    <span class="text-sm text-gray-600">{{ $metatag->meta_keywords }}</span>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap max-w-[200px] truncate overflow-hidden text-ellipsis">
                                    <span
                                        class="text-sm text-gray-900 truncate block">{{ $metatag->javascript_code }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 {{ $metatag->is_active ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $metatag->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="inline-flex">
                                        <a href="{{ route('seo-tags.show', $metatag->id) }}}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <x-icon name="eye" class="w-4 h-4 mr-1" />
                                            View
                                        </a>
                                        <a href="{{ route('seo-tags.edit', $metatag->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                            Edit
                                        </a>
                                        <x-modal id="delete-metatag-{{ $metatag->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                    <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                    Delete
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Delete SEO (Meta) Detail</h3>
                                            </x-slot>

                                            <div>
                                                <form action="{{ route('seo-tags.destroy', $metatag->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="p-6">
                                                        <div class="mb-6">
                                                            <div class="flex justify-center mb-4">
                                                                <div
                                                                    class="h-12 w-12 flex items-center justify-center bg-red-100 rounded-full">
                                                                    <x-icon name="exclamation-triangle"
                                                                        class="h-6 w-6 text-red-600" />
                                                                </div>
                                                            </div>
                                                            <h3
                                                                class="text-lg font-medium text-gray-900 text-center mb-2">
                                                                Confirm SEO (Meta) Detail Deletion</h3>
                                                            <p class="text-center text-gray-600">
                                                                Are you sure you want to delete the SEO (Meta) Detail:
                                                                <strong>{{ $metatag->page_name }}</strong>?
                                                            </p>
                                                            <p class="text-center text-red-600 text-sm mt-4">
                                                                This action cannot be undone.
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
                                                        <button type="button" x-on:click="modalIsOpen = false"
                                                            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none text-white font-medium rounded-lg transition-colors flex items-center">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex items-center justify-center h-full w-full">
                                        <div class="flex flex-col items-center">
                                            <x-icon name="tag" class="w-10 h-10 text-gray-400 mb-2" />
                                            <h3 class="text-lg font-medium text-gray-700 mb-1">No SEO Data found</h3>
                                            <p class="text-sm text-gray-500">There are no SEO Data matching your
                                                criteria.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($metatags, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $metatags->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
