<x-layouts.app>
    <div class="w-full py-2 ">
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                <h2 class="text-2xl font-medium text-gray-700">All package</h2>
            </div>
            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price ($)</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Old Price ($)</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price (€)</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Old Price (€)</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration (Hours)</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($packages as $index => $package)
                            <tr class="hover:bg-gray-50 transition-colors duration-150"
                                data-package="{{ $package->title }}">
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $package->title }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 {{ isset($package->price) ? 'text-gray-900' : 'text-red-500' }}">
                                                {{ $package->price ?? '(not set)' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 {{ isset($package->old_price) ? 'text-gray-900' : 'text-red-500' }}">
                                                {{ $package->old_price ?? '(not set)' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 {{ isset($package->europe_price) ? 'text-gray-900' : 'text-red-500' }}">
                                                {{ $package->europe_price ?? '(not set)' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-medium text-gray-900 {{ isset($package->europe_old_price) ? 'text-gray-900' : 'text-red-500' }}">
                                                {{ $package->europe_old_price ?? '(not set)' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $package->duration }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="flex px-6 py-5 whitespace-nowrap text-sm font-medium text-center my-3">
                                    <div class="flex space-x-3">
                                        <button type="button" onclick="openModal('view-{{ $package->id }}')"
                                            class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-yellow-600 hover:bg-green-100 transition-colors duration-150"
                                            title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>

                                        </button>
                                    </div>
                                    <div class="flex space-x-3">
                                        <button type="button" onclick="openModal('edit-{{ $package->id }}')"
                                            class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150"
                                            title="Edit">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                    {{-- <div class="flex space-x-3">  
                                            <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure you need to Delete this package?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="group flex items-center justify-center h-8 w-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg></button>
                                            </form> 
                                        </div>  --}}
                                </td>
                            </tr>
                            @include('admin.packages.edit', ['package' => $package])
                            @include('admin.packages.view', ['package' => $package])
                        @endforeach
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

<script>
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }

    document.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('[id^="edit-"]');
        modals.forEach(function(modal) {
            if (event.target === modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    });

    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
