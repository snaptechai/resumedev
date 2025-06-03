<x-layouts.app>
    <div class="w-full py-6">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Meta Tag Details</h2> 
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Page Name</p>
                        <p class="text-lg font-medium text-gray-900">{{ $seoTag->page_name }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Page URL</p>
                        <p class="text-lg text-gray-900">{{ $seoTag->url ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Meta Title</p>
                        <p class="text-lg text-gray-900">{{ $seoTag->meta_title }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Meta Keywords</p>
                        <p class="text-lg text-gray-900">{{ $seoTag->meta_keywords ?? '-' }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Meta Description</p>
                        <p class="text-gray-800">{{ $seoTag->meta_description }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Google Tag Script</p>
                        <pre class="bg-gray-100 p-3 rounded text-gray-800 text-sm overflow-auto">{{ $seoTag->google_tag_script ?? '-' }}</pre>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold {{ $seoTag->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $seoTag->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-end border-t border-gray-200 pt-5 mt-6">
                    <a href="{{ route('seo-tags.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </a> 
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
