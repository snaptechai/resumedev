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
                            <input type="text" id="page_name" name="page_name" value="{{ old('page_name') }}"
                                required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter unique page name">
                        </div>

                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700 mb-1">
                                Page URL
                            </label>
                            <input type="text" id="url" name="url" value="{{ old('url') }}"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter page URL">
                            <p class="mt-2 text-sm text-gray-500">
                                You can only have one meta tag/details for one URL. Keep this empty to apply tags and
                                scripts to the whole website. When there is a global meta tag activated and you also
                                have a URL specific tag, title and description will get replaced by specific URL title
                                and description. Keywords and scripts will be appended. So if you have one script in
                                global tag and one in specific tag, both will be executed when visiting that page.
                                <br><strong>Note:</strong> URL should be a relative path starting with "/", such as
                                /about or /contact-us. Do not include the domain name.
                            </p>
                        </div>

                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                required
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
                            <textarea id="meta_keywords" name="meta_keywords" rows="3" required
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Enter keywords separated by commas">{{ old('meta_keywords') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">
                                Keywords should be separated by comma (,). Example: resume, cv, portfolio
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4 bg-gray-50 p-5 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Scripts & Status
                        </h3>

                        <div>
                            <label for="javascript_code" class="block text-sm font-medium text-gray-700 mb-1">
                                JavaScript Code
                            </label>
                            <textarea id="javascript_code" name="javascript_code" rows="15"
                                class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                                placeholder="Paste javascript code or any tracking script">{{ old('javascript_code') }}</textarea>
                        </div>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-[#BCEC88] focus:ring-[#BCEC88]">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
                    <a href="{{ route('seo-tags.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
                        Add Meta Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
