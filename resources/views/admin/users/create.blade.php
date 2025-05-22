<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Create New User</h2>

            </div>

            @include('admin.massage-bar')

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label for="create-fullname" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name
                        </label>
                        <input type="text" id="create-fullname" name="full_name" required
                            value="{{ old('full_name') }}"
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    <div>
                        <label for="create-username" class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>
                        <input type="text" id="create-username" name="username" required
                            value="{{ old('username') }}"
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    <div>
                        <label for="create-type" class="block text-sm font-medium text-gray-700 mb-2">
                            User Type
                        </label>
                        <div class="relative">
                            <select id="create-type" name="type" required
                                class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-10 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                                <option value="">Select user type</option>
                                <option value="System" {{ old('type') == 'System' ? 'selected' : '' }}>System</option>
                                <option value="Writer" {{ old('type') == 'Writer' ? 'selected' : '' }}>Writer</option>
                                <option value="Client" {{ old('type') == 'Client' ? 'selected' : '' }}>Client</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="create-password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password
                        </label>
                        <input type="password" id="create-password" name="password" required
                            class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    </div>

                    <div>
                        <label for="create-password-confirm" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <input type="password" id="create-password-confirm" name="password_confirmation" required
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
                                        <input type="checkbox" id="permission-{{ $permission->id }}"
                                            name="permissions[]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 text-[#6b8f3b] border-gray-300 rounded focus:ring-[#BCEC88]">
                                        <label for="permission-{{ $permission->id }}"
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
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
