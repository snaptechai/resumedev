<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Redirect Links</h2>
                <x-modal id="create-link">
                    <x-slot name="trigger">
                        <button x-on:click="modalIsOpen = true" type="button"
                            class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 mr-1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Redirect Link
                        </button>
                    </x-slot>

                    <x-slot name="header">
                        <h3 class="text-lg font-semibold">Create New Redirect Link</h3>
                    </x-slot>

                    <div>
                        @include('admin.redirect-links.create')
                    </div>
                </x-modal>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Link #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Original URL</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                New URL</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Note</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Added Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($redirect_links as $index => $link)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                                    {{ $link->id }}
                                </td>
                                <td
                                    class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100 max-w-64 truncate">
                                    {{ $link->original_url }}
                                </td>
                                <td
                                    class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100 max-w-64 truncate">
                                    {{ $link->new_url }}
                                </td>
                                <td
                                    class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100 max-w-64 truncate">
                                    {{ $link->note }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ $link->added_date }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium border-b border-gray-100">
                                    <div class="flex gap-2">
                                        <x-modal id="edit-link-{{ $link->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                    Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Edit Redirect Link</h3>
                                            </x-slot>

                                            <div>
                                                @include('admin.redirect-links.edit', ['val' => $link])
                                            </div>
                                        </x-modal>

                                        <x-modal id="delete-link-{{ $link->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                    <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                    Delete
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Delete Redirect Link</h3>
                                            </x-slot>

                                            <div>
                                                <form action="{{ route('redirect-links.destroy', $link->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <div class="p-6">
                                                        <div class="mb-6">
                                                            <div class="flex justify-center mb-4">
                                                                <div
                                                                    class="h-12 w-12 flex items-center justify-center bg-red-100 rounded-full">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        fill="none" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="currentColor"
                                                                        class="w-6 h-6 text-red-600">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <h3
                                                                class="text-lg font-medium text-gray-900 text-center mb-2">
                                                                Confirm Link Deletion</h3>
                                                            <p class="text-center text-gray-600">
                                                                Are you sure you want to delete this redirect link from
                                                                <strong>{{ $link->original_url }}</strong> to
                                                                <strong>{{ $link->new_url }}</strong>?
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
                                                            Delete Link
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
                                <td colspan="6" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-10 h-10 text-gray-400 mb-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                                        </svg>
                                        <h3 class="mt-2 text-base font-medium text-gray-900">No redirect links found
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">Add your first redirect link to manage URL
                                            redirections</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($redirect_links, 'links'))
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    {{ $redirect_links->links() }}
                </div>
            @endif
        </div>
    </div>
    </div>
</x-layouts.app>
