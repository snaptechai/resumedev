<x-layouts.app>
    <div class="w-full py-2 "> 
        @if(count($coupons) > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"> 
                <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                    <h2 class="text-sm font-medium text-gray-700">All Coupons</h2>
                    <div class="flex items-center"> 
                        <div class="relative inline-block text-left">
                            <button type="button" onclick="openModal('create-coupon')" class="inline-flex items-center px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" id="actions-menu-button" aria-expanded="false" aria-haspopup="true"> Add New Coupon +
                            </button> 
                        </div>
                    </div> 
                </div>
                @include('admin.massage-bar')
                
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coupon</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount %</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">One Time</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added Date</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($coupons as $index => $coupon)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->coupon }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->price }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->start_date }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->end_date }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->one_time }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $coupon->added_date }}</div> 
                                            </div>
                                        </div>
                                    </td> 
                                    <td class="flex px-6 py-5 whitespace-nowrap text-sm font-medium text-center my-3">
                                        <div class="flex space-x-3">
                                            <button type="button" onclick="openModal('edit-{{ $coupon->id }}')" class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150" title="Edit">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="flex space-x-3">  
                                            <form action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" onsubmit="return confirm('Are you sure you need to Delete this Coupon?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="group flex items-center justify-center h-8 w-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg></button>
                                            </form> 
                                        </div> 
                                    </td>
                                </tr>
                                @include('admin.coupon.edit', ['coupon' => $coupon])
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('admin.coupon.create')
                 
                @if(method_exists($coupons, 'links'))
                    <div class="bg-white px-6 py-4 border-t border-gray-100">
                        {{ $coupons->links() }}
                    </div>
                @endif
            </div> 
            @else 
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="relative w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="h-12 w-12 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-xl font-bold text-gray-900">No active banners</h3>
                    <p class="mt-2 text-gray-500">Create your first banner campaign to engage visitors with timely promotions and announcements.</p>
                    <div class="mt-8">
                        <a href="{{ route('banner.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-400 text-white rounded-lg font-semibold text-sm shadow-md hover:from-green-700 hover:to-green-500 transform transition duration-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Your First Banner
                        </a>
                    </div>
                </div>
            </div>
        @endif
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
</script>