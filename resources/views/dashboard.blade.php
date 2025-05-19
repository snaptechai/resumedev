<x-layouts.app>
    <div class="flex min-h-screen w-full flex-col bg-gray-50 dark:bg-gray-900">
                
                <div class="p-4 lg:p-6">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Welcome back! Here's a summary of your business</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- Total Users -->
                        <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800 dark:shadow-gray-800/20">
                            <div class="absolute right-2 top-2 rounded-full bg-blue-100 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Total Users</h3>
                            <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</div>
                            <div class="inline-flex items-center text-xs font-medium text-green-600 dark:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span>+5.2% from last month</span>
                            </div>
                        </div>

                        <!-- Total Orders -->
                        <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800 dark:shadow-gray-800/20">
                            <div class="absolute right-2 top-2 rounded-full bg-purple-100 p-2 text-purple-600 dark:bg-purple-900/30 dark:text-purple-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</h3>
                            <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Order::count() }}</div>
                            <div class="inline-flex items-center text-xs font-medium text-green-600 dark:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span>+3.4% from last week</span>
                            </div>
                        </div>

                        <!-- Total Revenue -->
                        <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800 dark:shadow-gray-800/20">
                            <div class="absolute right-2 top-2 rounded-full bg-green-100 p-2 text-green-600 dark:bg-green-900/30 dark:text-green-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</h3>
                            <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-white">Rs. {{ number_format(\App\Models\Payment::sum('amount'), 2) }}</div>
                            <div class="inline-flex items-center text-xs font-medium text-green-600 dark:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span>+2.5% from last month</span>
                            </div>
                        </div>

                        <!-- Total Reviews -->
                        <div class="group relative overflow-hidden rounded-xl bg-white p-6 shadow transition-all hover:shadow-lg dark:bg-gray-800 dark:shadow-gray-800/20">
                            <div class="absolute right-2 top-2 rounded-full bg-yellow-100 p-2 text-yellow-600 dark:bg-yellow-900/30 dark:text-yellow-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Total Reviews</h3>
                            <div class="mb-1 text-3xl font-bold text-gray-900 dark:text-white">{{ \App\Models\Review::count() }}</div>
                            <div class="inline-flex items-center text-xs font-medium text-green-600 dark:text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                                <span>+8.1% from last week</span>
                            </div>
                        </div>
                    </div>

                    <!-- Charts & Recent Data -->
                    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-2">
                        <!-- Recent Users -->
                        <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
                            <div class="mb-4 flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Latest Registered Users</h2>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                            </div>
                            <div class="space-y-4">
                                @foreach (\App\Models\User::latest('registered_date')->take(5)->get() as $user)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                                            <span class="text-sm font-medium">{{ substr($user->full_name, 0, 2) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->full_name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email ?? 'No email provided' }}</p>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->registered_date->format('Y-m-d') }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Recent Orders -->
                        <div class="rounded-xl bg-white p-6 shadow dark:bg-gray-800">
                            <div class="mb-4 flex items-center justify-between">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Orders</h2>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">View All</a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:border-gray-700 dark:text-gray-400">
                                            <th class="pb-3 pt-0">Order ID</th>
                                            <th class="pb-3 pt-0">Status</th>
                                            <th class="pb-3 pt-0">Amount</th>
                                            <th class="pb-3 pt-0">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach (\App\Models\Order::latest('id')->take(5)->get() as $order)
                                        <tr>
                                            <td class="py-3 text-sm font-medium text-gray-900 dark:text-white">
                                                #{{ $order->id }}
                                            </td>
                                            <td class="py-3">
                                                <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                    Completed
                                                </span>
                                            </td>
                                            <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                                Rs. {{ number_format($order->amount ?? 0, 2) }}
                                            </td>
                                            <td class="py-3 text-sm text-gray-500 dark:text-gray-400">
                                                {{ isset($order->created_at) ? $order->created_at->format('M d, Y') : 'N/A' }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Chart -->
                    <div class="mt-6 rounded-xl bg-white p-6 shadow dark:bg-gray-800">
                        <div class="mb-4 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Sales Overview</h2>
                            <div class="flex items-center space-x-2">
                                <button type="button" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">Week</button>
                                <button type="button" class="rounded-lg border border-blue-500 bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700 dark:border-blue-500 dark:bg-blue-900/30 dark:text-blue-300">Month</button>
                                <button type="button" class="rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">Year</button>
                            </div>
                        </div>
                        <div class="h-80">
                            <!-- Chart placeholder -->
                            <div class="flex h-full w-full items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 dark:border-gray-700 dark:bg-gray-900">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-500 dark:text-gray-400">Sales chart will render here</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Connect to your sales data to display chart</p>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</x-layouts.app>