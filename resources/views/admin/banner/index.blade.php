<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Banner Management</h2>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Banner #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Description</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Duration</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                End Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Timer Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Banner Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banners as $banner)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $banner->id }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 flex items-center justify-center rounded-md"
                                            style="background-color: {{ $banner->background_color }}">
                                            <span class="text-xs font-bold"
                                                style="color: {{ $banner->font_color }}">T</span>
                                        </div>
                                        <div class="ml-3">
                                            <span
                                                class="text-sm text-gray-600">{{ Str::limit($banner->description, 50) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $banner->number_of_dates }} days</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($banner->end_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($banner->timmer_status == 'active')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer"
                                            {{ $banner->banner_status == 'active' ? 'checked' : '' }}
                                            data-banner-id="{{ $banner->id }}"
                                            data-status="{{ $banner->banner_status }}"
                                            onchange="toggleBannerStatus(this)">
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#BCEC88]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#BCEC88]">
                                        </div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-modal id="edit-banner-{{ $banner->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                    Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Edit Banner</h3>
                                            </x-slot>

                                            <div class="p-4">
                                                @include('admin.banner.edit', ['banner' => $banner])
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="rectangle-stack" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No banners found</h3>
                                        <p class="text-sm text-gray-500">There are no banner campaigns configured yet.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($banners, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $banners->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>

<script>
    function toggleBannerStatus(checkbox) {
        const bannerId = checkbox.getAttribute('data-banner-id');
        const newStatus = checkbox.checked ? 'active' : 'inactive';

        fetch(`/update-banner-status/${bannerId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    banner_status: newStatus
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {} else {
                    checkbox.checked = !checkbox.checked;
                    alert("Error updating banner status");
                }
            })
            .catch(error => {
                checkbox.checked = !checkbox.checked;
                console.error("Error:", error);
                alert("An error occurred while updating banner status");
            });
    }
</script>
