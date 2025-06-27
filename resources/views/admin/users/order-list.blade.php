<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-semibold text-gray-900">{{ $statusTitle }} Orders</h3>
        <div class="text-sm text-gray-500">
            {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }}
        </div>
    </div>

    @if($orders->count() > 0)
        <div class="hidden lg:block">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order Details
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Package
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">#{{ substr($order->id, -3) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $order->id) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">{{ $order->package->title ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">Package Details</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full 
                                        @if($order->order_status == 4) bg-green-100 text-green-800
                                        @elseif($order->order_status == 5) bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ $order->orderStatus->step ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $order->currency_symbol }}{{ number_format($order->total_price, 2) }}</div>
                                    <div class="text-sm text-gray-500">Total Amount</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($order->added_date)->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->added_date)->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('orders.show', $order->id) }}"
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
        </div>

        <div class="lg:hidden space-y-4">
            @foreach ($orders as $order)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="h-10 w-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">#{{ substr($order->id, -3) }}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</div>
                                    <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->added_date)->format('M d, Y H:i') }}</div>
                                </div>
                            </div>
                            <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full 
                                @if($order->order_status == 4) bg-green-100 text-green-800
                                @elseif($order->order_status == 5) bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ $order->orderStatus->step ?? 'N/A' }}
                            </span>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Package:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $order->package->name ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Amount:</span>
                                <span class="text-sm font-bold text-gray-900">{{ $order->currency_symbol }}{{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <button class="w-full text-blue-600 hover:text-blue-900 font-medium text-sm transition-colors duration-200">
                                View Order Details
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($orders->count() > 10)
            <div class="mt-6 flex justify-center">
                <button class="bg-white border border-gray-300 rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                    Load More Orders
                </button>
            </div>
        @endif

    @else
        <div class="text-center py-12">
            <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No {{ $statusTitle }} Orders</h3>
            <p class="text-gray-500 text-sm max-w-sm mx-auto">
                There are currently no orders with "{{ $statusTitle }}" status for this user.
            </p>
        </div>
    @endif
</div>