<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 gap-4">
        <div>
            <label for="edit-fullname-{{ $user->id }}" class="block mb-1 text-sm font-medium">Full Name</label>
            <input type="text" id="edit-fullname-{{ $user->id }}" name="full_name" value="{{ $user->full_name }}"
                required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>

        <div>
            <label for="edit-username-{{ $user->id }}" class="block mb-1 text-sm font-medium">Username</label>
            <input type="text" id="edit-username-{{ $user->id }}" value="{{ $user->username }}" disabled
                class="w-full rounded-radius border border-outline bg-neutral-100 px-3 py-2 text-sm text-neutral-600 cursor-not-allowed dark:border-outline-dark dark:bg-neutral-800 dark:text-neutral-400">
            <p class="mt-1 text-xs text-neutral-500">Username cannot be changed after creation</p>
        </div>

        <div>
            <label for="edit-type-{{ $user->id }}" class="block mb-1 text-sm font-medium">User Type</label>
            <select id="edit-type-{{ $user->id }}" name="type" required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                <option value="System" {{ $user->type === 'System' ? 'selected' : '' }}>System</option>
                <option value="Writer" {{ $user->type === 'Writer' ? 'selected' : '' }}>Writer</option>
                <option value="Client" {{ $user->type === 'Client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>

        <div>
            <label for="edit-password-{{ $user->id }}" class="block mb-1 text-sm font-medium">Password (Leave blank
                to keep current)</label>
            <input type="password" id="edit-password-{{ $user->id }}" name="password"
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>

        <div>
            <label for="edit-password-confirm-{{ $user->id }}" class="block mb-1 text-sm font-medium">Confirm
                Password</label>
            <input type="password" id="edit-password-confirm-{{ $user->id }}" name="password_confirmation"
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>
    </div>

    <div class="flex justify-end gap-2 mt-6">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-primary rounded-radius cursor-pointer">
            Update
        </button>
    </div>
</form>
