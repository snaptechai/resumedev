<div id="edit-{{ $coupon->id }}" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all"> 
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Coupon
            </h3>
            <button type="button" onclick="closeModal('edit-{{ $coupon->id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        
        <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">  
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6"> 
                    <div>
                        <label for="coupon-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Coupon Code
                        </label>
                        <input 
                            type="text" 
                            name="coupon" 
                            id="coupon-{{ $coupon->id }}" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3"
                            placeholder="Enter coupon code..."
                            value="{{ $coupon->coupon }}"
                        >
                    </div>
                     
                    <div>
                        <label for="price-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Discount Amount (%)
                        </label>
                        <div class="relative">
                            <input 
                                type="number" 
                                name="price" 
                                id="price-{{ $coupon->id }}" 
                                min="1"  
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3 pl-10"
                                value="{{ $coupon->price }}"
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="start_date-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Start Date
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="start_date" 
                                id="start_date-{{ $coupon->id }}" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3 pl-10"
                                value="{{ $coupon->start_date }}"
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="end_date-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            End Date
                        </label>
                        <div class="relative">
                            <input 
                                type="date" 
                                name="end_date" 
                                id="end_date-{{ $coupon->id }}" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3 pl-10"
                                value="{{ $coupon->end_date }}"
                            >
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                            One-Time Use
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    name="one_time" 
                                    value="1" 
                                    class="sr-only peer" 
                                    {{ $coupon->one_time == "yes" ? 'checked' : '' }}
                                >
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ $coupon->one_time == 1 ? 'Yes' : 'No' }}
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    {{-- <div>
                        <label for="used_by-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Used By
                        </label>
                        <input 
                            type="text" 
                            name="used_by" 
                            id="used_by-{{ $coupon->id }}" 
                            class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3"
                            value="{{ $coupon->used_by }}"
                            readonly
                        >
                    </div> --}}
                    
                    {{-- <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="added_by-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Added By
                            </label>
                            <input 
                                type="text" 
                                id="added_by-{{ $coupon->id }}" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3 bg-gray-100 dark:bg-gray-600"
                                value="{{ $coupon->added_by }}"
                                readonly
                            >
                        </div>
                        
                        <div>
                            <label for="added_date-{{ $coupon->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Added Date
                            </label>
                            <input 
                                type="text" 
                                id="added_date-{{ $coupon->id }}" 
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:border-green-500 focus:ring-green-500 dark:bg-gray-700 dark:text-white p-3 bg-gray-100 dark:bg-gray-600"
                                value="{{ $coupon->added_date }}"
                                readonly
                            >
                        </div>
                    </div> --}}
                </div>
            </div>
             
            <div class="flex items-center justify-end p-5 border-t dark:border-gray-700 gap-3">
                <button 
                    type="button" 
                    onclick="closeModal('edit-{{ $coupon->id }}')" 
                    class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2.5 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 focus:outline-none text-white font-medium rounded-lg transition-colors"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>