<x-layouts.app>
    <div class="w-full py-2 "> 
        @if(count($banners) > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"> 
                <div class="bg-gradient-to-r from-gray-50 to-white border-b border-gray-100 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Active Campaigns</h2>
                    <p class="text-sm text-gray-500 mt-1">Showing all {{ count($banners) }} banner campaigns</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dates</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timer Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Banner Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($banners as $index => $banner)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $banner->description }}</div>
                                                @if($banner->preview_text)
                                                    <div class="text-xs text-gray-500 mt-1 truncate max-w-xs">{{ $banner->preview_text }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-7 w-7 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                                <svg class="h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-700">
                                                {{ $banner->number_of_dates }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @if($banner->timmer_status == 'active')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700">
                                                <span class="h-2 w-2 mr-2 rounded-full bg-green-500"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-50 text-gray-600">
                                                <span class="h-2 w-2 mr-2 rounded-full bg-gray-400"></span>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" class="sr-only peer" {{ $banner->banner_status == 'active' ? 'checked' : '' }} 
                                                data-banner-id="{{ $banner->id }}" 
                                                data-status="{{ $banner->banner_status }}" 
                                                onchange="toggleBannerStatus(this)">
                                            <div class="relative w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                        </label>
                                    </td> 
                                    <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex space-x-3">
                                            <button type="button" onclick="openModal('edit-{{ $banner->id }}')" class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150" title="Edit">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('admin.banner.edit', ['banner' => $banner])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 
                @if(method_exists($banners, 'links'))
                    <div class="bg-white px-6 py-4 border-t border-gray-100">
                        {{ $banners->links() }}
                    </div>
                @endif
            </div> 
        @endif
    </div> 
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
    </script>
</x-layouts.app>

<script>
    document.addEventListener('DOMContentLoaded', function() { 
        const bgColorPicker = document.getElementById('background_color-{{ $banner->id }}');
        const fontColorPicker = document.getElementById('font_color-{{ $banner->id }}');
        
        if (bgColorPicker && bgColorPicker.nextElementSibling) {
            bgColorPicker.addEventListener('input', function() {
                bgColorPicker.nextElementSibling.value = this.value;
                updatePreview();
            });
        }
        
        if (fontColorPicker && fontColorPicker.nextElementSibling) {
            fontColorPicker.addEventListener('input', function() {
                fontColorPicker.nextElementSibling.value = this.value;
                updatePreview();
            });
        }
         
        const descriptionField = document.getElementById('description-{{ $banner->id }}');
        if (descriptionField) {
            descriptionField.addEventListener('input', updatePreview);
        }
        
        function updatePreview() {
            const preview = document.querySelector('#edit-{{ $banner->id }} .p-4.rounded-lg.mb-6');
            const description = document.getElementById('description-{{ $banner->id }}').value;
            
            if (preview) {
                preview.style.backgroundColor = bgColorPicker.value;
                preview.style.color = fontColorPicker.value;
                preview.querySelector('p').textContent = description;
            }
        }
    });
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }


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
            if (data.success) {
                alert("Banner status updated successfully"); 
            } else {
                alert("Error updating banner status"); 
                checkbox.checked = !checkbox.checked;
            }
        })
        .catch(error => {
            console.log("Error:", error); 
            checkbox.checked = !checkbox.checked;
        });
    }
</script>