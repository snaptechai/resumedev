<form action="{{ route('faqs.store') }}" method="POST">
    @csrf
    <div class="p-6 space-y-4">
        <div>
            <label for="create-question" class="block text-sm font-medium text-gray-700 mb-2">
                Question
            </label>
            <input type="text" id="create-question" name="question" value="{{ old('question') }}" required
                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
        </div>

        <div>
            <label for="create-answer" class="block text-sm font-medium text-gray-700 mb-2">
                Answer
            </label>
            <textarea id="create-answer" name="answer" rows="4" required
                class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">{{ old('answer') }}</textarea>
        </div>
    </div>

    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
            Create FAQ
        </button>
    </div>
</form>
