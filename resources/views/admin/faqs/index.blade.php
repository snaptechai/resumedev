<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Frequently Asked Questions</h2>
                <x-modal id="create-faq">
                    <x-slot name="trigger">
                        <button x-on:click="modalIsOpen = true" type="button"
                            class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                            <x-icon name="plus" class="w-4 h-4 mr-1.5" />
                            Add FAQ
                        </button>
                    </x-slot>

                    <x-slot name="header">
                        <h3 class="text-lg font-semibold">Create New FAQ</h3>
                    </x-slot>

                    <div class="p-4">
                        @include('admin.faqs.create')
                    </div>
                </x-modal>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                FAQ #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Question</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Answer</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $faq)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $faq->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ Str::limit($faq->question, 70) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ Str::limit($faq->answer, 80) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-modal id="edit-faq-{{ $faq->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                    Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Edit FAQ</h3>
                                            </x-slot>

                                            <div class="p-4">
                                                @include('admin.faqs.edit', ['faq' => $faq])
                                            </div>
                                        </x-modal>

                                        <x-modal id="delete-faq-{{ $faq->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                    <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                    Delete
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Delete FAQ</h3>
                                            </x-slot>

                                            <div>
                                                @include('admin.faqs.delete', [
                                                    'faq' => $faq,
                                                ])
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="question-mark-circle" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No FAQs found</h3>
                                        <p class="text-sm text-gray-500">There are no FAQs yet. Create one to get
                                            started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($faqs, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $faqs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
