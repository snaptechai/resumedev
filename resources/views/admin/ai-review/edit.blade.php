<form action="{{ route('ai_review.update', $Review->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="p-6 space-y-4"> 
        <div>
            <label for="email-{{ $Review->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                Email
            </label>
            <input type="email" id="email-{{ $Review->id }}" name="email"
                   value="{{ old('email', $Review->email) }}" readonly
                   class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                   placeholder="Enter email">
        </div>  
        <div>
            <label for="description-{{ $Review->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                Description
            </label>
            <textarea id="description-{{ $Review->id }}" name="description" rows="10"
                      class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] border"
                      placeholder="Enter description">{{ old('description', $Review->description) }}</textarea>
        </div> 
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Is Sent
            </label>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_sent" value="1" class="sr-only peer"
                    {{ old('is_sent', $Review->is_sent) == 1 ? 'checked' : '' }}>
                <div
                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-[#BCEC88]/30 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#BCEC88]">
                </div>
            </label>
        </div>
    </div>
 
    <div class="flex items-center justify-end p-6 gap-3 border-t border-gray-200">
        <button type="button" x-on:click="modalIsOpen = false"
                class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit"
                class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors">
            Update Review
        </button>
    </div>
</form>
