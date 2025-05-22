<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Users</h2>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                    <x-icon name="plus" class="w-4 h-4 mr-1.5" />
                    Add User
                </a>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                User #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Full Name</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Username</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Type</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Permissions</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Registered Date</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $typeColors = [
                                    'System' => 'bg-blue-50 text-blue-800 border-blue-100',
                                    'Writer' => 'bg-green-50 text-green-800 border-green-100',
                                    'Client' => 'bg-purple-50 text-purple-800 border-purple-100',
                                ];
                                $typeColor = $typeColors[$user->type] ?? 'bg-gray-50 text-gray-800 border-gray-100';
                            @endphp
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $user->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $user->full_name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $user->username }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-md {{ $typeColor }}">
                                        {{ $user->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1">
                                        @php
                                            $totalPermissions = count($user->accessUsers);
                                            $displayLimit = 1;
                                        @endphp
                                        @forelse($user->accessUsers->take($displayLimit) as $accessUser)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                @php
                                                    $accessName = \App\Models\Access::find($accessUser->access);
                                                @endphp
                                                {{ $accessName ? $accessName->access : 'Unknown Permission' }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-gray-500">No permissions</span>
                                        @endforelse
                                        @if ($totalPermissions > $displayLimit)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                +{{ $totalPermissions - $displayLimit }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ date('M d, Y', strtotime($user->registered_date)) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                            <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                            Edit
                                        </a>

                                        @if ($user->id !== Auth::id())
                                            <x-modal id="delete-user-{{ $user->id }}">
                                                <x-slot name="trigger">
                                                    <button x-on:click="modalIsOpen = true"
                                                        class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:underline">
                                                        <x-icon name="trash" class="w-4 h-4 mr-1" />
                                                        Delete
                                                    </button>
                                                </x-slot>

                                                <x-slot name="header">
                                                    <h3 class="text-lg font-semibold">Delete User</h3>
                                                </x-slot>

                                                <div>
                                                    @include('admin.users.delete', [
                                                        'user' => $user,
                                                    ])
                                                </div>
                                            </x-modal>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="user" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No users found</h3>
                                        <p class="text-sm text-gray-500">There are no users matching your criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
