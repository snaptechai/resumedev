<div id="edit-{{ $template->id }}" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all">
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Template
            </h3>
            <button type="button" onclick="closeModal('edit-{{ $template->id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        
        <form action="{{ route('templates.update', $template->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    <div>
                        <label for="package-edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Package
                        </label>
                        <select name="package" id="package-edit" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3" required>
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}" {{ $template->package == $package->id ? 'selected' : '' }}>
                                    {{ $package->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                     
                    <div>
                        <label for="image-edit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Image
                        </label>
                        <input 
                            type="file" 
                            name="image" 
                            id="image-new" 
                            class="w-full border-gray-300 dark:border-gray-600 shadow-sm dark:bg-gray-700 dark:text-white p-3"
                            accept="image/*"
                            required
                            onchange="EditpreviewImage(event,{{ $template->id }})"
                        >
                        @if($template->image)
                            <img id="Edit-image-preview-{{ $template->id }}" src="{{ asset('storage/'.$template->image) }}" alt="Template Image" class="mt-3 w-32 h-32 rounded-lg shadow-md">
                        @else
                            <img id="Edit-image-preview-{{ $template->id }}" src="" alt="Template Image" class="mt-3 w-32 h-32 rounded-lg shadow-md hidden">
                        @endif
                    </div>
                </div>
            </div>
             
            <div class="flex items-center justify-end p-5 border-t dark:border-gray-700 gap-3">
                <button type="button" onclick="closeModal('edit-template')" class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2.5 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 focus:outline-none text-white font-medium rounded-lg transition-colors">
                    Update Template
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function EditpreviewImage(event,id) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(`Edit-image-preview-${id}`).src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
