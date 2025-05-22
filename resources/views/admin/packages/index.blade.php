<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Packages</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Package #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Title</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Price ($)</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Old Price ($)</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Price (€)</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Old Price (€)</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Duration (Hours)</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($packages as $package)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700">
                                    {{ $package->id }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ $package->title }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ isset($package->price) ? '$' . $package->price : 'not set' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ isset($package->old_price) ? '$' . $package->old_price : 'not set' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ isset($package->europe_price) ? '€' . $package->europe_price : 'not set' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ isset($package->europe_old_price) ? '€' . $package->europe_old_price : 'not set' }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100">
                                    {{ $package->duration }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium border-b border-gray-100">
                                    <div class="flex gap-2">
                                        <a href="{{ route('packages.edit', $package->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-10 h-10 text-gray-400 mb-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                        </svg>
                                        <h3 class="mt-2 text-base font-medium text-gray-900">No packages found</h3>
                                        <p class="mt-1 text-sm text-gray-500">Packages will appear here once they are
                                            created</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($packages, 'links'))
                <div class="bg-white px-6 py-4 border-t border-gray-100">
                    {{ $packages->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
