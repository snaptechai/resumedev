<form action="{{ route('page-details.update', $pageDetail->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="pb-4">
        <input type="hidden" name="type" value="{{ $pageDetail->type }}">
        <div class="mb-3">
            <input id="content-{{ $pageDetail->id }}" type="hidden" name="content" value="{{ $pageDetail->content }}">
            <trix-editor input="content-{{ $pageDetail->id }}" class="trix-content"></trix-editor>
        </div>
    </div>

    <div class="flex justify-end gap-2 mt-4">
        <button type="button" x-on:click="modalIsOpen = false;"
            class="px-4 py-2 text-sm font-medium border border-outline rounded-radius cursor-pointer">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 text-sm font-medium text-on-primary bg-primary border border-primary rounded-radius cursor-pointer">
            Update
        </button>
    </div>
</form>
