<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Addons Management</h2>
            </div>

            @include('admin.massage-bar')

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                addons #</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Package Name</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Title</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Description</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Description</th>
                            <th
                                class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-gray-200">
                                Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($addons as $addon)
                            <tr class="hover:bg-[#fcfcfa] transition-colors border-b border-gray-100 last:border-0">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $addon->id }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $addon->package->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $addon->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $addon->description }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $addon->price }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <x-modal id="edit-addon-{{ $addon->id }}">
                                            <x-slot name="trigger">
                                                <button x-on:click="modalIsOpen = true"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-sm font-medium text-gray-700 hover:text-[#6b8f3b] hover:underline">
                                                    <x-icon name="pencil-square" class="w-4 h-4 mr-1" />
                                                    Edit
                                                </button>
                                            </x-slot>

                                            <x-slot name="header">
                                                <h3 class="text-lg font-semibold">Edit addons</h3>
                                            </x-slot>

                                            <div class="p-4">
                                                @include('admin.addon.edit', ['addon' => $addon])
                                            </div>
                                        </x-modal>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center border-b border-gray-100">
                                    <div class="flex flex-col items-center">
                                        <x-icon name="rectangle-stack" class="w-10 h-10 text-gray-400 mb-2" />
                                        <h3 class="text-lg font-medium text-gray-700 mb-1">No Addons found</h3>
                                        <p class="text-sm text-gray-500">There are no Addons campaigns configured yet.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (method_exists($addons, 'links'))
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $addons->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
