<x-layouts.app>
    <div class="w-full py-2">
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-5 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Edit AI Review</h2>
                <a href="{{ route('ai-review.index') }}"
                    class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                    Back to List
                </a>
            </div>
            @include('admin.massage-bar')

            <form action="{{ route('ai-review.update', $aiReview->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <input type="email" id="email" name="email"
                                value="{{ old('email', $aiReview->email) }}" readonly
                                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 bg-gray-50 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                                placeholder="Enter email">
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Resume File
                            </label>
                            @if ($aiReview->file_path)
                                <a href="{{ asset('storage/' . $aiReview->file_path) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] transition-colors">
                                    <x-icon name="document-text" class="w-4 h-4 mr-2" />
                                    View Resume
                                </a>
                            @else
                                <span class="text-gray-500 text-sm">No file uploaded</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Review Description
                            </label>
                            <div class="flex gap-2">
                                <a href="{{ route('ai-review.regenerate', $aiReview->id) }}"
                                    onclick="return confirm('Are you sure you want to regenerate this review? This process may take a few minutes.')"
                                    class="px-3 py-1.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 text-[#5D7B2B] rounded-lg transition-colors text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#BCEC88]/30">
                                    <x-icon name="arrow-path" class="w-4 h-4 mr-1 inline" />
                                    Regenerate
                                </a>
                                @if ($aiReview->description && $aiReview->email)
                                    <a href="{{ route('ai-review.send-email', $aiReview->id) }}"
                                        onclick="return confirm('Are you sure you want to send this review via email?')"
                                        class="px-3 py-1.5 bg-[#5D7B2B] hover:bg-[#5D7B2B]/90 text-white rounded-lg transition-colors text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#5D7B2B]/30">
                                        <x-icon name="envelope" class="w-4 h-4 mr-1 inline" />
                                        Send Email
                                    </a>
                                @endif
                            </div>
                        </div>

                        <textarea id="tinymce-editor" name="description" class="tinymce-editor">{{ old('description', $aiReview->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="is_sent" class="flex items-center">
                            <input type="checkbox" name="is_sent" id="is_sent" value="1"
                                class="rounded border-gray-300 text-[#BCEC88] focus:ring-[#BCEC88] focus:border-[#BCEC88]"
                                {{ old('is_sent', $aiReview->is_sent) == 1 ? 'checked' : '' }}>
                            <span class="ml-2 text-sm font-medium text-gray-700">Mark as sent</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
                    <a href="{{ route('ai-review.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
