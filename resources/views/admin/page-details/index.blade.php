<x-layouts.app>
    <div class="flex flex-col">
        <div class="flex flex-col gap-2">
            <x-typography.heading accent size="xl" level="1">
                Page Content
            </x-typography.heading>
            <x-typography.subheading size="lg">
                Edit content that appears on different pages of the website.
            </x-typography.subheading>
            <x-separator class="my-4" />
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
                    <th scope="col" class="p-4">Type</th>
                    <th scope="col" class="p-4">Preview</th>
                    <th scope="col" class="p-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @foreach ($pageDetails as $pageDetail)
                    <tr>
                        <td class="p-4">
                            {{ $pageDetail->id }}
                        </td>
                        <td class="p-4">
                            <span
                                class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $pageDetail->type }}
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="max-w-xl overflow-hidden truncate">
                                {{ Str::limit(strip_tags($pageDetail->content), 300) }}
                            </div>
                        </td>

                        <td class="p-4">
                            <div class="flex justify-end">
                                <x-modal>
                                    <x-slot name="trigger">
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="whitespace-nowrap rounded-radius bg-primary border border-primary px-4 py-2 text-sm font-medium tracking-wide text-on-primary transition hover:opacity-75 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-primary-dark dark:border-primary-dark dark:text-on-primary-dark dark:focus-visible:outline-primary-dark">
                                            Edit
                                        </button>
                                    </x-slot>

                                    <x-slot name="header">
                                        <h3 class="text-lg font-semibold">Edit {{ $pageDetail->type }} Content</h3>
                                    </x-slot>

                                    <div class="p-4">
                                        @include('admin.page-details.edit', [
                                            'pageDetail' => $pageDetail,
                                        ])
                                    </div>
                                </x-modal>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @empty(count($pageDetails))
                    <tr>
                        <td colspan="4" class="p-4 text-center">No records found.</td>
                    </tr>
                @endempty
            </tbody>
        </table>
    </div>
</x-layouts.app>
