<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="p-6">
        <div class="mb-6">
            <div class="flex justify-center mb-4">
                <div class="h-12 w-12 flex items-center justify-center bg-red-100 rounded-full">
                    <x-icon name="exclamation-triangle" class="h-6 w-6 text-red-600" />
                </div>
            </div>
            <h3 class="text-lg font-medium text-gray-900 text-center mb-2">Confirm User Deletion</h3>
            <p class="text-center text-gray-600">
                Are you sure you want to delete the user: <strong>{{ $user->full_name }}</strong>?
            </p>
            <p class="text-center text-red-600 text-sm mt-4">
                This action cannot be undone.
            </p>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 focus:outline-none text-white font-medium rounded-lg transition-colors flex items-center">
            Delete User
        </button>
    </div>
</form>
