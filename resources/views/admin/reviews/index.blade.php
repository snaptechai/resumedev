<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Reviews</h2>
            </div>


            <div class="flex border-b border-gray-200 overflow-x-auto">
                <a href="{{ route('reviews.index', ['filter' => 'all']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ !request('filter') || request('filter') == 'all' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    All Reviews
                </a>
                <a href="{{ route('reviews.index', ['filter' => 'pending']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ request('filter') == 'pending' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    Pending Reviews
                </a>
                <a href="{{ route('reviews.index', ['filter' => 'approved']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ request('filter') == 'approved' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    Approved Reviews
                </a>
                <a href="{{ route('reviews.index', ['filter' => 'rejected']) }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ request('filter') == 'rejected' ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    Rejected Reviews
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Review #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Name</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Review</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Stars</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Service Start</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Recommended</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $review->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $review->name }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">{{ Str::limit($review->review, 50) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($review->star)
                                        <span class="text-sm text-yellow-500">{{ $review->star }}★</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $review->service_start }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $review->recommend_star }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($review->added_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            '0' => 'bg-yellow-50 text-yellow-800 border-yellow-100',
                                            '1' => 'bg-green-50 text-green-800 border-green-100',
                                            '2' => 'bg-red-50 text-red-800 border-red-100',
                                        ];
                                        $statusLabels = [
                                            '0' => 'Pending',
                                            '1' => 'Approved',
                                            '2' => 'Rejected',
                                        ];
                                        $statusColor =
                                            $statusColors[$review->status] ??
                                            'bg-gray-50 text-gray-800 border-gray-100';
                                        $statusLabel = $statusLabels[$review->status] ?? 'Unknown';
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-modal id="edit-review-{{ $review->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                    Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Update Review Status</h3>
                                            </x-slot>

                                            <div class="p-6">
                                                <form id="edit-form-{{ $review->id }}"
                                                    data-id="{{ $review->id }}">
                                                    <div class="mb-4">
                                                        <label
                                                            class="block text-sm font-medium text-gray-700 mb-2">Review
                                                            Status</label>
                                                        <select name="status"
                                                            class="w-full rounded-lg border-gray-300 py-2 px-3 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88]">
                                                            <option value="0"
                                                                {{ $review->status == '0' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="1"
                                                                {{ $review->status == '1' ? 'selected' : '' }}>Approved
                                                            </option>
                                                            <option value="2"
                                                                {{ $review->status == '2' ? 'selected' : '' }}>Rejected
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="flex items-center justify-end space-x-3">
                                                        <button type="button" x-on:click="modalIsOpen = false"
                                                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 rounded-lg text-[#5D7B2B]">
                                                            Update Status
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-modal>

                                        <x-modal id="delete-review-{{ $review->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                    <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                    Delete
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Delete Review</h3>
                                            </x-slot>

                                            <div>
                                                <form action="{{ route('reviews.destroy', $review->id) }}"
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
                                                                Confirm Review Deletion</h3>
                                                            <p class="text-center text-gray-600">
                                                                Are you sure you want to delete this review from
                                                                <strong>{{ $review->name }}</strong>?
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
                                                            Delete Review
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
                                    <div class="flex flex-col items-center">
                                        <x-icon name="chat-bubble-oval-left" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No reviews found</h3>
                                        <p class="text-sm text-gray-500">There are no reviews matching your criteria.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($reviews->isNotEmpty() && method_exists($reviews, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[id^="edit-form-"]').forEach(form => {
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                const reviewId = this.getAttribute("data-id");
                const status = this.querySelector('select[name="status"]').value;

                fetch(`/review/${reviewId}`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector(
                                'meta[name="csrf-token"]').getAttribute("content")
                        },
                        body: JSON.stringify({
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert("Failed to update status.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred.");
                    });
            });
        });
    });
</script>
