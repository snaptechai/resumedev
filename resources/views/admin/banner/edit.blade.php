<div id="edit-{{ $banner->id }}" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all"> 
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Banner
            </h3>
            <button type="button" onclick="closeModal('edit-{{ $banner->id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        
        <form action="{{ route('banner.update', $banner->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6"> 
                <div class="p-4 rounded-lg mb-6 flex items-center justify-center" 
                     style="background-color: {{ $banner->background_color }}; color: {{ $banner->font_color }}; min-height: 80px;">
                    <p class="text-center font-medium">{{ $banner->description }}</p>
                    <div class="ml-4 flex items-center" x-show="{{ $banner->timmer_status == 'active' ? 'true' : 'false' }}">
                        <span class="text-center font-bold">⏱️ 00:00:00</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    <div class="md:col-span-2">
                        <label for="description-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Banner Message
                        </label>
                        <textarea 
                            name="description" 
                            id="description-{{ $banner->id }}" 
                            rows="2" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white resize-none p-3"
                            placeholder="Enter banner message here..."
                        >{{ $banner->description }}</textarea>
                    </div>
                     
                    <div>
                        <label for="number_of_dates-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Number of Dates
                        </label>
                        <div class="relative">
                            <input 
                                type="number" 
                                name="number_of_dates" 
                                id="number_of_dates-{{ $banner->id }}" 
                                min="1" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white p-3 pl-10"
                                value="{{ $banner->number_of_dates }}"
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                     
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                            <div>
                                <label for="background_color-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Background Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input 
                                        type="color" 
                                        name="background_color" 
                                        id="background_color-{{ $banner->id }}" 
                                        class="h-10 w-10 rounded border border-gray-300 cursor-pointer"
                                        value="{{ $banner->background_color }}"
                                    >
                                    <input 
                                        type="text" 
                                        value="{{ $banner->background_color }}" 
                                        class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white p-3"
                                        readonly
                                    >
                                </div>
                            </div>
                             
                            <div>
                                <label for="font_color-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Font Color
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input 
                                        type="color" 
                                        name="font_color" 
                                        id="font_color-{{ $banner->id }}" 
                                        class="h-10 w-10 rounded border border-gray-300 cursor-pointer"
                                        value="{{ $banner->font_color }}"
                                    >
                                    <input 
                                        type="text" 
                                        value="{{ $banner->font_color }}" 
                                        class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white p-3"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            Timer Status
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="timmer_status" 
                                    value="active" 
                                    class="sr-only peer" 
                                    {{ $banner->timmer_status == 'active' ? 'checked' : '' }}
                                >
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $banner->timmer_status == 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            Banner Status
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="banner_status" 
                                    value="active" 
                                    class="sr-only peer" 
                                    {{ $banner->banner_status == 'active' ? 'checked' : '' }}
                                >
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $banner->banner_status == 'active' ? 'Active' : 'Inactive' }}
                                </span>
                            </label>
                        </div>
                    </div>
                    
                </div>
            </div>
             
            <div class="flex items-center justify-end p-5 border-t dark:border-gray-700 gap-3">
                <button 
                    type="button" 
                    onclick="closeModal('edit-{{ $banner->id }}')" 
                    class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 focus:outline-none text-white font-medium rounded-lg transition-colors"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>