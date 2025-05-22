<x-layouts.app>
    <div class="w-full py-2 "> 
        @if(count($messages) > 0)

            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"> 
                <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                    <h2 class="text-2xl font-medium text-gray-700">Orders With Pending Massages</h2> 
                </div> 
                
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Number</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th> 
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th> 
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($messages as $index => $message)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $message->oid) }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <span
                                            class="text-sm text-gray-600">{{ $message->order->user->full_name }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <span
                                            class="text-sm text-gray-600">{{ $message->order->end_date }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <span class="text-sm {{ $message->order->express == 1 ? 'text-red-600' : 'text-gray-600' }}">
                                            {{ $message->order->express == 0 ? 'Normal' : 'Express' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                    <a href="{{ route('orders.show', $message->oid) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                        <x-icon name="eye" class="w-4 h-4 mr-1" />
                                        View Order
                                    </a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 
                @if(method_exists($messages, 'links'))
                    <div class="bg-white px-6 py-4 border-t border-gray-100">
                        {{ $messages->links() }}
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
                    <h3 class="mt-2 text-xl font-bold text-gray-900">No active Coupon</h3>
                    <p class="mt-2 text-gray-500">Create your first article to grab your visitors' attention with timely promotions and special coupon offers. Encourage them to save more while exploring your site!</p> 
                </div>
            </div>
        @endif 
    </div>  
</x-layouts.app>
 