<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ substr($user->full_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $user->full_name }}</h1>
                            <p class="text-sm text-gray-500">User Profile & Order Management</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium transition-colors duration-200 shadow-sm">Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-8">
            @php
                $completed = $orders->where('order_status', 4)->count();
                $refunded = $orders->where('order_status', 5)->count();
                $current = $orders->whereNotIn('order_status', [4,5])->count();
                $total = $orders->count();
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $current }}</p>
                            <p class="text-gray-600 text-sm mt-1">Current Orders</p>
                        </div>
                        <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $refunded }}</p>
                            <p class="text-gray-600 text-sm mt-1">Refund Orders</p>
                        </div>
                        <div class="h-12 w-12 bg-red-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $completed }}</p>
                            <p class="text-gray-600 text-sm mt-1">Completed Orders</p>
                        </div>
                        <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $total }}</p>
                            <p class="text-gray-600 text-sm mt-1">Total Orders</p>
                        </div>
                        <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">User Details</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Full Name</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $user->full_name }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Username</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $user->username }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">User Type</span>
                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ $user->type }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Orders</span>
                            <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">View All Orders</a>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-600">Registered Date</span>
                            <span class="text-sm text-gray-900">{{ $user->registered_date ? $user->registered_date->format('M d, Y H:i') : '(not set)' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="text-sm font-medium text-gray-600">Last Modified</span>
                            <span class="text-sm text-gray-900">{{ $user->last_modified_date ? $user->last_modified_date->format('M d, Y H:i') : '(not set)' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="order-tabs" x-data="{ tab: '{{ $statuses->first()->id }}' }" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Order Management</h2>
                </div>
                
                <div class="border-b border-gray-200">
                    <nav class="flex overflow-x-auto" aria-label="Tabs">
                        @foreach ($statuses as $status)
                            <button
                                @click="tab = '{{ $status->id }}'"
                                class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors duration-200"
                                :class="{ 
                                    'border-blue-500 text-blue-600 bg-blue-50': tab === '{{ $status->id }}',
                                    'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== '{{ $status->id }}'
                                }"
                            >
                                {{ $status->step }}
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                      :class="{ 
                                          'bg-blue-100 text-blue-800': tab === '{{ $status->id }}',
                                          'bg-gray-100 text-gray-800': tab !== '{{ $status->id }}'
                                      }">
                                    {{ $orders->where('order_status', $status->id)->count() }}
                                </span>
                            </button>
                        @endforeach
                    </nav>
                </div>
                
                <div class="p-6">
                    @foreach ($statuses as $status)
                        <div x-show="tab === '{{ $status->id }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-y-1" x-transition:enter-end="opacity-100 transform translate-y-0">
                            @include('admin.users.order-list', [
                                'orders' => $orders->where('order_status', $status->id),
                                'statusTitle' => $status->step
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-layouts.app>