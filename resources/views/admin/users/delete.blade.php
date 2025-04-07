<form action="{{ route('users.destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <p class="pb-4">Are you sure you want to delete the user: <strong>{{ $user->full_name }}</strong>?</p>
    <p class="pb-4 text-sm text-red-600">This action cannot be undone.</p>

    <div class="flex justify-end gap-2 mt-4">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-on-primary bg-danger border border-danger rounded-radius cursor-pointer">
            Delete
        </button>
    </div>
</form>
