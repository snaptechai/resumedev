<div class="bg-white shadow-xl rounded-2xl overflow-hidden max-w-3xl mx-auto">
    <div class="p-6 space-y-6"> 
        <div>
            <label class="block text-sm font-semibold text-gray-500 mb-1">Email</label>
            <p class="text-base text-gray-900 break-words">{{ $Review->email }}</p>
        </div>
 
        <div>
            <label class="block text-sm font-semibold text-gray-500 mb-1">Description</label>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <textarea readonly rows="10" class="w-full bg-transparent text-gray-800 text-sm leading-relaxed resize-none focus:outline-none">
{{ $Review->description }}
                </textarea>
            </div>
        </div> 
        <div>
            <label class="block text-sm font-semibold text-gray-500 mb-1">Status</label>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                {{ $Review->is_sent ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $Review->is_sent ? 'Sent' : 'Not Sent' }}
            </span>
        </div>
    </div>
 
    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 border-t">
        <a href="{{ route('ai-review.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
            ← Back
        </a>
    </div>
</div>
