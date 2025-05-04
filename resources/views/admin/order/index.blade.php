<x-layouts.app>
    <div class="w-full py-2"> 
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                <h2 class="text-2xl font-medium text-gray-700">Orders</h2> 
            </div>

            @include('admin.massage-bar') 
            
            <div class="flex border-b">
                @php
                    $tabs = [
                        'all' => 'All Orders',
                        'pending' => 'Pending Orders',
                        'completed' => 'Completed Orders',
                        'accepted' => 'Accepted Orders',
                        'canceled' => 'Canceled Orders',
                        'rejected' => 'Rejected Orders',
                    ];
                @endphp

                @foreach ($tabs as $key => $label)
                    <a href="{{ route('order.index', ['tab' => $key]) }}"
                    class="px-4 py-2 text-sm font-semibold text-gray-700 border-b-2 {{ $tab === $key ? 'border-green-500 bg-green-100' : 'border-transparent hover:border-green-500' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
            
            <div class="overflow-x-auto mt-4">
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Order No</th> 
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Order Type</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Time Left</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Added Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Payment Status</th> 
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Total Price</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($Orders as $index => $Order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ 'RM' . sprintf('%06d', $Order->id) }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->order_type }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->end_date }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->uid }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->added_date }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->payment_status ?? '0.00' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $Order->total_price ?? '0.00' }}</td>
                                <td class="flex px-6 py-4 text-sm text-gray-500">
                                    <a href="{{ route('order.show', $Order->id) }}" target="_blank" class="group flex items-center justify-center h-8 w-8 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors duration-150" title="View">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <div class="flex space-x-3">
                                        <button type="button" onclick="openModal('edit-{{ $Order->id }}')" class="group flex items-center justify-center h-8 w-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 transition-colors duration-150" title="Edit">
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="flex items-center">  
                                        <form action="{{ route('order.destroy', $Order->id) }}" method="POST" onsubmit="return confirm('Are you sure you need to Delete this Order ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="group flex items-center justify-center h-8 w-8 rounded-full bg-red-50 text-red-600 hover:bg-red-100 transition-colors duration-150">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form> 
                                    </div>
                                </td>
                            </tr>
                            @include('admin.order.edit', ['Order' => $Order])
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="m-4">
                {{ $Orders->appends(['tab' => $tab])->links() }}
            </div>

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
</script>
