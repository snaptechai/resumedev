<x-layouts.app>
    <div class="w-full py-2 "> 
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"> 
                <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium text-gray-700">All Template</h2>
                    <div class="flex items-center"> 
                        <div class="relative inline-block text-left">
                            <button type="button" onclick="openModal('create-template')" class="inline-flex items-center px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="actions-menu-button" aria-expanded="false" aria-haspopup="true"> Add New Template +
                            </button> 
                        </div>
                    </div> 
                </div>
                @include('admin.massage-bar')
                <div class="px-4 pb-2">
                    <label for="packageFilter" class="text-sm font-medium text-gray-700 mr-2">Filter by Package:</label>
                    <select id="packageFilter" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option value="">All</option>
                        @foreach ($templates->pluck('packagename.title')->unique() as $packageTitle)
                            <option value="{{ $packageTitle }}">{{ $packageTitle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($templates as $index => $template)
                                <tr class="hover:bg-gray-50 transition-colors duration-150" data-package="{{ $template->packagename->title }}">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $template->packagename->title }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <img src="{{ 'storage/'.$template->image }}" alt="Template Image" class="w-24 h-24 object-cover rounded cursor-pointer" data-src="{{ 'storage/'.$template->image }}" id="image-thumbnail-{{ $template->id }}">

                                            </div>
                                        </div>
                                    </td>
                                    <td class="flex px-6 py-5 whitespace-nowrap text-sm font-medium text-center my-3">
                                        <div class="flex space-x-3">
                                            <button type="button" onclick="openModal('edit-{{ $template->id }}')" class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150" title="Edit">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex space-x-3">  
                                            <form action="{{ route('templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Are you sure you need to Delete this template?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="group flex items-center justify-center h-8 w-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg></button>
                                            </form> 
                                        </div> 
                                    </td>
                                </tr>
                                @include('admin.templates.edit', ['templates' => $templates])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('admin.templates.create')
                 
                @if(method_exists($templates, 'links'))
                    <div class="bg-white px-6 py-4 border-t border-gray-100">
                        {{ $templates->links() }}
                    </div>
                @endif
            </div>  
    </div>  
    @include('admin.templates.show-image')
 
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

    // Display the image in full size when clicked in the index table
    document.querySelectorAll('[id^="image-thumbnail"]').forEach(function(img) {
    img.addEventListener('click', function() {
        var imageSrc = img.getAttribute('data-src');
        document.getElementById('modal-image').src = imageSrc;
        document.getElementById('image-modal').classList.remove('hidden');
    });
    });

    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('image-modal').classList.add('hidden');
    }); 

    // Search function
    document.getElementById('packageFilter').addEventListener('change', function () {
        const selectedPackage = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const packageTitle = row.getAttribute('data-package').toLowerCase();
            if (!selectedPackage || packageTitle === selectedPackage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

