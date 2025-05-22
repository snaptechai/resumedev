<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label for="edit-fullname" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name
                        </label>
                        <input type="text" id="edit-fullname" name="full_name"
                            value="{{ old('full_name', $user->full_name) }}" required
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    <div>
                        <label for="edit-username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <input type="text" id="edit-username" value="{{ $user->username }}" disabled
                            class="w-full rounded-lg bg-gray-100 py-3 px-3 text-gray-500 border border-gray-300 cursor-not-allowed">
                        <p class="mt-2 text-sm text-gray-500">
                            Username cannot be changed after creation
                        </p>
                    </div>

                    <div>
                        <label for="edit-type" class="block text-sm font-medium text-gray-700 mb-2">
                            User Type
                        </label>
                        <div class="relative">
                            <select id="edit-type" name="type" required
                                class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-10 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                                <option value="System" {{ old('type', $user->type) === 'System' ? 'selected' : '' }}>
                                    System</option>
                                <option value="Writer" {{ old('type', $user->type) === 'Writer' ? 'selected' : '' }}>
                                    Writer</option>
                                <option value="Client" {{ old('type', $user->type) === 'Client' ? 'selected' : '' }}>
                                    Client</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="edit-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password (Leave blank to keep current)
                        </label>
                        <input type="password" id="edit-password" name="password"
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    <div>
                        <label for="edit-password-confirm" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <input type="password" id="edit-password-confirm" name="password_confirmation"
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    @if (auth()->user()->hasPermission('Manage user access'))
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                User Permissions
                            </label>
                            <div class="border border-gray-300 p-5 rounded-lg grid grid-cols-1 sm:grid-cols-3 gap-4">
                                @foreach ($permissions as $permission)
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" id="edit-permission-{{ $permission->id }}"
                                            name="permissions[]" value="{{ $permission->id }}"
                                            {{ $user->accessUsers->contains('access', $permission->id) ? 'checked' : '' }}
                                            class="w-4 h-4 text-[#6b8f3b] border-gray-300 rounded focus:ring-[#BCEC88]">
                                        <label for="edit-permission-{{ $permission->id }}"
                                            class="ml-2 text-sm text-gray-700">{{ $permission->access }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                                Select the permissions this user should have
                            </p>
                        </div>
                    @endif
                </div>

                <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
                    <a href="{{ route('users.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
