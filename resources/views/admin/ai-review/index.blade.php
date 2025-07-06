<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Addons Management</h2>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                id #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                E mail</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                File</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Description</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                is Sent</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aiReviews as $Review)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $Review->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $Review->email }}</span>
                                </td>
                                @php
                                    $filePath = $Review->file_path;
                                    $fileUrl = asset('storage/' . $filePath);
                                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                @endphp
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ $fileUrl }}" target="_blank" title="Open File">
                                        <x-icon name="document-text" outline /> 
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ Str::limit($Review->description, 50, '...') ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $Review->is_sent ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="flex px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-modal id="show-ai-review-{{ $Review->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="eye" class="w-4 h-4 mr-1" />
                                                    View
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">View</h3>
                                            </x-slot>

                                            <div class="p-4">
                                                @include('admin.ai-review.view', ['Review' => $Review])
                                            </div>
                                        </x-modal>
                                    </div>
                                    <div class="flex gap-2">
                                        <x-modal id="edit-ai-review-{{ $Review->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                   Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Edit Review</h3>
                                            </x-slot>

                                            <div class="p-4">
                                                @include('admin.ai-review.edit', ['Review' => $Review])
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="rectangle-stack" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No AI Reviews found</h3>
                                        <p class="text-sm text-gray-500">There are no AI Reviews configured yet.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($aiReviews, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $aiReviews->links() }}
                </div>
            @endif
        </div>
    </div> 
</x-layouts.app>
