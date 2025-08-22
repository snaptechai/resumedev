<x-layouts.app>
    <div class="w-full py-2 "> 
        @if(count($notifications) > 0)

            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100"> 
                <div class="px-4 py-3 border-b flex justify-between items-center mb-2">
                    <h2 class="text-2xl font-medium text-gray-700">Notifications</h2> 
                </div> 
                <div class="px-4 mb-4 flex justify-end">
                    @if(request('filter') === 'unread')
                        <a href="{{ route('notification.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                            Show All Notifications
                        </a>
                    @else
                        <a href="{{ route('notification.index', ['filter' => 'unread']) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded hover:bg-yellow-600">
                            Show Only Unread
                        </a>
                    @endif
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Number</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client Name</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notification</th> 
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th> 
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($notifications as $index => $notification)
                                <tr class="transition-colors duration-150 {{ ($notification->status == 0 && !$notification->is_read ) ? 'bg-yellow-100 hover:bg-yellow-200' : 'hover:bg-gray-50' }}">

                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center"> 
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $notification->order_id) }}</div> 
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-600">
                                            {{ $notification->order->user->full_name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <span class="text-sm text-gray-600">{{ $notification->notification }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <span class="text-sm {{ $notification->order->express == 1 ? 'text-red-600' : 'text-gray-600' }}">
                                            {{ $notification->order->express == 0 ? 'Normal' : 'Express' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap ">
                                        <form action="{{ route('notification.update', $notification->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-white bg-green-400 hover:bg-green-600 rounded">
                                                <x-icon name="eye" class="w-4 h-4 mr-1" />
                                                View
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                 
                @if(method_exists($notifications, 'links'))
                    <div class="bg-white px-6 py-4 border-t border-gray-100">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div> 
            
            @else 
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <div class="relative w-24 h-24 mx-auto mb-6 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="h-12 w-12 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
                        </svg>
                    </div>
                    <h3 class="mt-2 text-xl font-bold text-gray-900">No Notifications</h3>
                    <p class="mt-2 text-gray-500">
                        You're all caught up! There are no new notifications at the moment. Check back later for updates.
                    </p>
                </div>
            </div>
        @endif 
    </div>  
</x-layouts.app>
 