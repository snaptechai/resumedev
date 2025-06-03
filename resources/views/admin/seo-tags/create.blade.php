<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Create Meta Tag</h2>
            </div>

            @include('admin.massage-bar')

            <form action="{{ route('seo-tags.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4 bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Page Meta Info</h3>

                        <div>
                            <label for="page_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Page Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="page_name" name="page_name" value="{{ old('page_name') }}" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter unique page name">
                        </div>

                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700 mb-1">
                                Page URL
                            </label>
                            <input type="text" id="url" name="url" value="{{ old('url') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter page URL (optional)">
                        </div>

                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter meta title">
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="meta_description" name="meta_description" rows="3" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Keywords
                            </label>
                            <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter keywords separated by commas">
                        </div>
                    </div>

                    <div class="space-y-4 bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Scripts & Status</h3>

                        <div>
                            <label for="google_tag_script" class="block text-sm font-medium text-gray-700 mb-1">
                                Google Tag Script
                            </label>
                            <textarea id="google_tag_script" name="google_tag_script" rows="15"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Paste Google tag or any tracking script">{{ old('google_tag_script') }}</textarea>
                        </div>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-[#BCEC88] focus:ring-[#BCEC88]">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end border-t border-gray-200 pt-5 mt-6">
                    <button type="button" onclick="window.location='{{ route('seo-tags.index') }}'"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit"
                        class="ml-3 px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#000000] font-medium rounded-lg transition-colors">
                        Save Meta Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
