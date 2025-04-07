<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-1 gap-4">
        <div>
            <label for="create-fullname" class="block mb-1 text-sm font-medium">Full Name</label>
            <input type="text" id="create-fullname" name="full_name" required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>

        <div>
            <label for="create-username" class="block mb-1 text-sm font-medium">Username</label>
            <input type="text" id="create-username" name="username" required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>

        <div>
            <label for="create-type" class="block mb-1 text-sm font-medium">User Type</label>
            <select id="create-type" name="type" required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
                <option value="">Select user type</option>
                <option value="System">System</option>
                <option value="Writer">Writer</option>
                <option value="Client">Client</option>
            </select>
        </div>

        <div>
            <label for="create-password" class="block mb-1 text-sm font-medium">Password</label>
            <input type="password" id="create-password" name="password" required
                class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">
        </div>

        <div>
            <label for="create-password-confirm" class="block mb-1 text-sm font-medium">Confirm Password</label>
            <input type="password" id="create-password-confirm" name="password_confirmation" required
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
            Save
        </button>
    </div>
</form>
