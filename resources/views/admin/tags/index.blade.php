<x-layouts.app>
    <div class="flex flex-col">
        <div class="flex flex-col gap-2">
            <x-typography.heading accent size="xl" level="1">
                Tags
            </x-typography.heading>
            <x-typography.subheading size="lg">
                Manage tags that are used for categorizing articles.
            </x-typography.subheading>
            <x-separator class="my-4" />
        </div>

        <div class="flex justify-end items-center mb-4">
            <x-modal>
                <x-slot name="trigger">
                    <button
                        class="inline-flex justify-center items-center gap-2 whitespace-nowrap rounded-radius bg-primary border border-primary dark:border-primary-dark px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark cursor-pointer"
                        x-on:click="modalIsOpen = true">
                        <x-icon name="plus" class="w-5 h-5" />
                        Create
                    </button>
                </x-slot>

                <x-slot name="header">
                    <h3 class="text-lg font-semibold">Create Tag</h3>
                </x-slot>

                <div class="p-4">
                    @include('admin.tags.create')
                </div>
            </x-modal>
        </div>
    </div>

    <div class="overflow-hidden w-full overflow-x-auto rounded-sm border border-neutral-300 dark:border-neutral-700">
        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
            <thead
                class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">
                        ID
                    </th>
                    <th scope="col" class="p-4">Tag</th>
                    <th scope="col" class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @foreach ($tags as $tag)
                    <tr>
                        <td class="p-4">
                            {{ $tag->id }}
                        </td>
                        <td class="p-4">
                            {{ $tag->tag }}
                        </td>
                        <td class="p-4">
                            <div class="flex justify-end gap-2">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
                                            Edit
                                        </button>
                                    </x-slot>

                                    <x-slot name="header">
                                        <h3 class="text-lg font-semibold">Edit Tag</h3>
                                    </x-slot>

                                    <div class="p-4">
                                        @include('admin.tags.edit', ['tag' => $tag])
                                    </div>
                                </x-modal>

                                <x-modal>
                                    <x-slot name="trigger">
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="px-4 py-2 text-sm font-medium text-on-primary bg-danger border border-danger rounded-radius cursor-pointer"">
                                            Delete
                                        </button>
                                    </x-slot>

                                    <x-slot name="header">
                                        <h3 class="text-lg font-semibold">Delete Tag</h3>
                                    </x-slot>

                                    <div class="p-4">
                                        @include('admin.tags.delete', [
                                            'tag' => $tag,
                                        ])
                                    </div>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @empty(count($tags))
                    <tr>
                        <td colspan="3" class="p-4 text-center">No records found.</td>
                    </tr>
                @endempty
            </tbody>
        </table>
    </div>
</x-layouts.app>
