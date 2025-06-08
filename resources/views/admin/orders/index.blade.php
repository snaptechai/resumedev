<style>
    @keyframes blink {

        0%,
        100% {
            background-color: #faeded;
        }

        /* light yellow */
        50% {
            background-color: #f34848;
        }
    }

    .animate-blink {
        animation: blink 1.5s infinite;
    }
</style>
<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Orders</h2>

                <form method="GET" action="{{ route('orders.index') }}" class="flex items-center gap-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <x-icon name="magnifying-glass" class="h-4 w-4 text-gray-400" />
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-96 pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#BCEC88] focus:border-[#BCEC88] transition-colors"
                            placeholder="Search orders...">
                    </div>

                    <input type="hidden" name="order_status" value="{{ request('order_status') }}">

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                        Search
                    </button>

                    @if (request('search'))
                        <a href="{{ route('orders.index', ['order_status' => request('order_status')]) }}"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#BCEC88]/30 transition-colors">
                            <x-icon name="x-mark" class="h-4 w-4 mr-1" />
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            @include('admin.massage-bar')

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
                                Time Left</th>
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
                            <tr
                                class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0 {{ $order->needsAdminReply() ? 'animate-blink' : '' }}">

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $order->id) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($order->added_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $timeLeft = '';
                                        $isOverdue = false;

                                        if (
                                            $order->end_date &&
                                            \Carbon\Carbon::hasFormat($order->end_date, 'Y-m-d H:i:s')
                                        ) {
                                            $endDate = \Carbon\Carbon::parse($order->end_date);
                                            $now = \Carbon\Carbon::now();
                                            $timeLeft = $now->diffForHumans($endDate, true);
                                            $isOverdue = $now->gt($endDate);
                                        }
                                    @endphp
                                    @if ($timeLeft)
                                        <span
                                            class="text-sm {{ $isOverdue ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                            {{ $isOverdue ? 'Overdue by ' . $timeLeft : $timeLeft . ' left' }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
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
                                    @if ($order->payment_status == 'Success')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Success</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">{{ ucfirst($order->payment_status) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ $order->assignedWriter?->full_name ?? 'Not assigned' }}</span>
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
                                <td colspan="{{ auth()->user()->hasPermission('View order price & details') ? '8' : '7' }}"
                                    class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="document-text" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No orders found</h3>
                                        <p class="text-sm text-gray-500">
                                            @if (request('search'))
                                                No orders match your search criteria.
                                            @else
                                                There are no orders matching your criteria.
                                            @endif
                                        </p>
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
