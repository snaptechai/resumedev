<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit Package</h2>
            </div>
            @include('admin.massage-bar')

            <form action="{{ route('packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" name="title" id="title"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter title..." value="{{ $package->title }}">
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                Duration (Hours)
                            </label>
                            <input type="text" name="duration" id="duration"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                value="{{ $package->duration }}">
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price ($)
                            </label>
                            <input type="number" name="price" id="price" step="0.01"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                value="{{ $package->price }}">
                        </div>

                        <div>
                            <label for="old_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Old Price ($)
                            </label>
                            <input type="number" name="old_price" id="old_price" step="0.01"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                value="{{ $package->old_price }}">
                        </div>

                        <div>
                            <label for="europe_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Europe Price (€)
                            </label>
                            <input type="number" name="europe_price" id="europe_price" step="0.01"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                value="{{ $package->europe_price }}">
                        </div>

                        <div>
                            <label for="europe_old_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Europe Old Price (€)
                            </label>
                            <input type="number" name="europe_old_price" id="europe_old_price" step="0.01"
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                value="{{ $package->europe_old_price }}">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Short Description
                        </label>
                        <input id="short_description" type="hidden" name="short_description"
                            value="{{ $package->short_description }}">
                        <trix-editor input="short_description"
                            class="trix-content border border-gray-300 rounded-md p-3"></trix-editor>
                        @error('short_description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="full_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Description
                        </label>
                        <input id="full_description" type="hidden" name="full_description"
                            value="{{ $package->full_description }}">
                        <trix-editor input="full_description"
                            class="trix-content border border-gray-300 rounded-md p-3"></trix-editor>
                        @error('full_description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
                    <a href="{{ route('packages.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                        Update Package
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
