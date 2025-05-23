<form action="{{ route('banner.update', $banner->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-6">
        <div class="p-4 rounded-lg mb-6 flex items-center justify-center text-center text-wrap"
            style="background-color: {{ $banner->background_color }}; color: {{ $banner->font_color }}; min-height: 80px;">
            <p class="font-medium">{{ $banner->description }}</p>
            @if ($banner->timmer_status == 'active')
                <div class="ml-3 flex items-center">
                    <span class="font-bold">⏱️ 00:00:00</span>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="description-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Banner Message
                </label>
                <textarea name="description" id="description-{{ $banner->id }}" rows="2" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Enter banner message">{{ $banner->description }}</textarea>
            </div>

            <div>
                <label for="number_of_dates-{{ $banner->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Number of Days
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <x-icon name="calendar" class="h-5 w-5 text-gray-400" />
                    </div>
                    <input type="number" name="number_of_dates" id="number_of_dates-{{ $banner->id }}" min="1"
                        value="{{ $banner->number_of_dates }}" required
                        class="w-full pl-10 rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    Number of days the banner will be displayed
                </p>
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="background_color-{{ $banner->id }}"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            Background Color
                        </label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="background_color" id="background_color-{{ $banner->id }}"
                                class="h-10 w-10 rounded border cursor-pointer" value="{{ $banner->background_color }}"
                                onchange="document.getElementById('bg-color-text-{{ $banner->id }}').value = this.value; updatePreview{{ $banner->id }}()">
                            <input type="text" id="bg-color-text-{{ $banner->id }}"
                                value="{{ $banner->background_color }}"
                                class="flex-1 rounded-lg border-gray-300 py-2 px-3 text-gray-700" readonly>
                        </div>
                    </div>

                    <div>
                        <label for="font_color-{{ $banner->id }}"
                            class="block text-sm font-medium text-gray-700 mb-2">
                            Font Color
                        </label>
                        <div class="flex items-center space-x-2">
                            <input type="color" name="font_color" id="font_color-{{ $banner->id }}"
                                class="h-10 w-10 rounded border cursor-pointer" value="{{ $banner->font_color }}"
                                onchange="document.getElementById('font-color-text-{{ $banner->id }}').value = this.value; updatePreview{{ $banner->id }}()">
                            <input type="text" id="font-color-text-{{ $banner->id }}"
                                value="{{ $banner->font_color }}"
                                class="flex-1 rounded-lg border-gray-300 py-2 px-3 text-gray-700" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Timer Status
                </label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="timmer_status" value="active"
                        {{ $banner->timmer_status == 'active' ? 'checked' : '' }} class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#BCEC88]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#BCEC88]">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-700">
                        Enable countdown timer
                    </span>
                </label>

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Banner Status
                </label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="banner_status" value="active"
                        {{ $banner->banner_status == 'active' ? 'checked' : '' }} class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-[#BCEC88]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#BCEC88]">
                    </div>
                    <span class="ml-3 text-sm font-medium text-gray-700">
                        Display banner on website
                    </span>
                </label>
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
            Update Banner
        </button>
    </div>
</form>

<script>
    function updatePreview{{ $banner->id }}() {
        const preview = document.querySelector('[x-data] .p-4.rounded-lg.mb-6');
        const bgColor = document.getElementById('background_color-{{ $banner->id }}').value;
        const fontColor = document.getElementById('font_color-{{ $banner->id }}').value;
        const description = document.getElementById('description-{{ $banner->id }}').value;

        if (preview) {
            preview.style.backgroundColor = bgColor;
            preview.style.color = fontColor;
            preview.querySelector('p').textContent = description;
        }
    }

    // Initialize event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionField = document.getElementById('description-{{ $banner->id }}');
        if (descriptionField) {
            descriptionField.addEventListener('input', updatePreview{{ $banner->id }});
        }
    });
</script>
