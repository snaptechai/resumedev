<style>
    @keyframes blink {
    0%, 100% { background-color: #faeded; } /* light yellow */
    50% { background-color: #f34848; }
    }

    .animate-blink {
    animation: blink 1.5s infinite;
    }
</style>
<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Orders</h2>
            </div>

            @include('admin.massage-bar')
            <form method="GET" action="{{ route('orders.index') }}" class="px-6 py-4 flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="border border-gray-300 rounded-md px-3 py-2 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-[#6b8f3b]"
                    placeholder="Search by Order ID, Customer, or Writer">
                
                <input type="hidden" name="order_status" value="{{ request('order_status') }}">

                <button type="submit"
                    class="bg-[#6b8f3b] hover:bg-[#5a7931] text-white text-sm font-medium py-2 px-4 rounded-md">
                    Search
                </button>
            </form>

            <div class="flex border-b border-gray-200 overflow-x-auto">
                @php
                    $orderStatuses = \App\Models\OrderSetp::all();
                @endphp

                <a href="{{ route('orders.index') }}"
                    class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ !$order_status ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                    All Orders
                </a>

                @foreach ($orderStatuses as $status)
                    <a href="{{ route('orders.index', ['order_status' => $status->id]) }}"
                        class="px-5 py-3 text-sm font-medium whitespace-nowrap border-b-2 {{ $order_status == $status->id ? 'border-[#6b8f3b] text-[#6b8f3b] bg-[#f9faf7]' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300' }}">
                        {{ $status->step }}
                    </a>
                @endforeach
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Order #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Order Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Customer</th>
                            @if (auth()->user()->hasPermission('View order price & details'))
                                <th
                                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                    Amount</th>
                            @endif
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Status</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Payment</th>

                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Writer</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            @php
                                $orderStatus = \App\Models\OrderSetp::find($order->order_status);

                                $statusColors = [
                                    1 => 'bg-amber-50 text-amber-800 border-amber-100',
                                    2 => 'bg-green-50 text-green-800 border-green-100',
                                    3 => 'bg-blue-50 text-blue-800 border-blue-100',
                                    4 => 'bg-red-50 text-red-800 border-red-100',
                                    5 => 'bg-red-50 text-red-800 border-red-100',
                                ];
                                $statusColor =
                                    $statusColors[$order->order_status] ?? 'bg-gray-50 text-gray-800 border-gray-100';

                                $customer = \App\Models\User::find($order->uid);
                                
                            @endphp
                            {{-- @if () --}}
                                    <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0 {{ $order->needsAdminReply() ? 'animate-blink' : '' }}">
                            {{-- @else
                                    <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                            @endif  --}}

                            {{-- <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0"> --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $order->id) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($order->added_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ $customer ? $customer->full_name : 'User #' . $order->uid }}</span>
                                </td>
                                @if (auth()->user()->hasPermission('View order price & details'))
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm font-medium text-gray-900">${{ number_format($order->total_price, 2) }}</span>
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md {{ $statusColor }}">
                                        {{ $orderStatus ? $orderStatus->step : 'Unknown' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($order->payment_status == 'paid')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Paid</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $order->assignedWriter?->full_name ?? 'Not assigned' }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                        <x-icon name="eye" class="w-4 h-4 mr-1" />
                                        View Order
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="document-text" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No orders found</h3>
                                        <p class="text-sm text-gray-500">There are no orders matching your criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->appends(['order_status' => $order_status])->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
