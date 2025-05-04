<x-layouts.app>
    <div class="w-full py-2"> 
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                <h2 class="text-2xl font-medium text-gray-700">Order - {{ $order->id }} </h2>
            </div>

            <div class="w-full px-4 py-6 bg-white dark:bg-gray-800 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Order Details</h2>
            
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Order No:</strong> {{ 'RM' . sprintf('%06d', $order->id) }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Order Type:</strong> {{ $order->order_type }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Express:</strong> {{ $order->express == 1 ? 'Yes' : 'No' }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Added By:</strong> {{ $order->added_by }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Added Date:</strong> {{ $order->added_date }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Last Modified By:</strong> {{ $order->last_modified_by }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Last Modified Date:</strong> {{ $order->last_modified_date }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Payment Status:</strong> {{ $order->payment_status }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Order Status:</strong> {{ $order->order_status }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Coupon:</strong> {{ $order->coupon }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Total Price ($):</strong> {{ $order->total_price }}</div>
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">End Date:</strong> {{ $order->end_date }}</div> 
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Signed Date/Time:</strong> {{ $order->signed_date_time }}</div> 
                    <div><strong class="text-green-700 pr-4 dark:text-gray-300">Writer:</strong> {{ $order->writer }}</div> 
                </div>
            </div>
            

        </div>
    </div>   
</x-layouts.app>

