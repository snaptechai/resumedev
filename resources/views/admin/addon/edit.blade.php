<form action="{{ route('addon.update', $addon->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Title --}}
            <div class="md:col-span-2">
                <label for="title-{{ $addon->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Addon Title
                </label>
                <input type="text" name="title" id="title-{{ $addon->id }}" value="{{ old('title', $addon->title) }}"
                    required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border">
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label for="description-{{ $addon->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea name="description" id="description-{{ $addon->id }}" rows="3" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                    placeholder="Enter addon description">{{ old('description', $addon->description) }}</textarea>
            </div>

            {{-- Price --}}
            <div>
                <label for="price-{{ $addon->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Price
                </label>
                <input type="number" name="price" id="price-{{ $addon->id }}" step="0.01" min="0"
                    value="{{ old('price', $addon->price) }}" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border">
            </div>

            {{-- Package ID --}}
            <div>
                <label for="package_id-{{ $addon->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Package Name
                </label>
                <select name="package_id" id="package_id-{{ $addon->id }}" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border">
                    <option value="" disabled selected>Select a package</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}" {{ $addon->package_id == $package->id ? 'selected' : '' }}>
                            {{ $package->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#000000] font-medium rounded-lg transition-colors">
            Update Addon
        </button>
    </div>
</form>
