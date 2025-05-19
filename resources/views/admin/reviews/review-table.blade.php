<div class="overflow-x-auto">
    <table class="w-full divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Review</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Stars</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Service Start</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Recommended</th>
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                @if ($status == 0)
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                @endif
                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($reviews as $index => $review)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $review->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $review->review }}</td>
                    <td class="px-6 py-4 text-sm text-yellow-500">{{ $review->star }}★</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $review->service_start }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $review->recommend_star }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $review->added_date }}</td>
                    @if ($status == 0)
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <select class="status-dropdown border border-gray-300 rounded px-2 py-1"
                                data-id="{{ $review->id }}">
                                <option value="0" {{ $review->status == '0' ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $review->status == 'Approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="2" {{ $review->status == '2' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </td>
                    @endif
                    <td class="px-6 py-4 text-sm text-gray-500">
                        <div class="flex items-center justify-center">
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you need to Delete this Review ?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="group flex items-center justify-center h-8 w-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150"><svg
                                        class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
