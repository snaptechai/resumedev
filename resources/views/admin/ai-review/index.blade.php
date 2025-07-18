<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">AI Review</h2>
            </div>

            @include('admin.massage-bar')

            <div class="flex border-b border-gray-200 overflow-x-auto">
                <a href="{{ route('ai-review.index', ['filter' => 'all']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ !request('filter') || request('filter') == 'all' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    All Reviews
                </a>
                <a href="{{ route('ai-review.index', ['filter' => 'sent']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ request('filter') == 'sent' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    Sent Reviews
                </a>
                <a href="{{ route('ai-review.index', ['filter' => 'not_sent']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ request('filter') == 'not_sent' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    Not Sent Reviews
                </a>
            </div>

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
                                    @php
                                        $statusColor = $Review->is_sent
                                            ? 'bg-green-50 text-green-800 border-green-100'
                                            : 'bg-yellow-50 text-yellow-800 border-yellow-100';
                                        $statusLabel = $Review->is_sent ? 'Sent' : 'Not Sent';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('ai-review.edit', $Review->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="rectangle-stack" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No AI Reviews found</h3>
                                        <p class="text-sm text-gray-500">There are no AI Reviews matching your criteria.
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
