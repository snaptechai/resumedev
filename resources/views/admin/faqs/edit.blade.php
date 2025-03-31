<form action="{{ route('faqs.update', $faq->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="pb-4">
        <label for="edit-question-{{ $faq->id }}" class="block mb-1 text-sm font-medium">Question</label>
        <input type="text" id="edit-question-{{ $faq->id }}" name="question" value="{{ $faq->question }}" required
            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">

        <label for="edit-answer-{{ $faq->id }}" class="block mt-4 mb-1 text-sm font-medium">Answer</label>
        <textarea id="edit-answer-{{ $faq->id }}" name="answer" rows="4" required
            class="w-full rounded-radius border border-outline bg-surface px-3 py-2 text-sm text-on-surface placeholder-on-surface/60 focus:border-primary focus:outline-none dark:border-outline-dark dark:bg-surface-dark dark:text-on-surface-dark dark:placeholder-on-surface-dark/60 dark:focus:border-primary-dark">{{ $faq->answer }}</textarea>
    </div>
    <div class="flex justify-end gap-2 mt-4">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-primary rounded-radius cursor-pointer">
            Update
        </button>
    </div>
</form>
