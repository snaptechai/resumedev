<form x-data="{
    status: '{{ $order->order_status }}',
    isCompleted() { return this.status === '4'; }
}" action="{{ route('orders.update', $order->id) }}" method="POST" enctype="multipart/form-data"
    @submit.prevent="isCompleted() && !$refs.completionFiles.files.length ? alert('Please attach at least one file to complete the order.') : $el.submit()">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-2">
        <div>
            <label for="order_status-{{ $order->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                Order Status
            </label>
            <div class="relative">
                <select name="order_status" id="order_status-{{ $order->id }}" x-model="status"
                    class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-10 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
                    @php
                        $orderStatuses = \App\Models\OrderSetp::all();
                    @endphp

                    @foreach ($orderStatuses as $status)
                        <option value="{{ $status->id }}" {{ $order->order_status == $status->id ? 'selected' : '' }}>
                            {{ $status->step }}
                        </option>
                    @endforeach
                </select>
            </div>
            <p class="mt-2 text-sm text-gray-500">
                Changing the status will notify the customer about the update.
            </p>
        </div>

        <div x-show="isCompleted()" x-transition>
            <label for="completion_files-{{ $order->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                Completion Files <span class="text-red-600">*</span>
            </label>
            <div class="mt-1">
                <input type="file" name="completion_files[]" id="completion_files-{{ $order->id }}"
                    x-ref="completionFiles" :required="isCompleted()"
                    class="w-full rounded-lg border-gray-300 py-2 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    multiple>
            </div>
            <p class="mt-2 text-sm text-gray-500">
                These files will be sent to the customer in the order ready email.
            </p>
        </div>
        @if (auth()->user()->hasPermission('View order price & details'))
            <div>
                <label for="writer-{{ $order->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                    Writer
                </label>
                <div class="relative">
                    <select name="writer" id="writer-{{ $order->id }}"
                        class="w-full rounded-lg border-gray-300 py-3 pl-3 pr-10 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">

                        @php
                            $writers = \App\Models\user::where('type', 'Writer')->get();
                        @endphp

                        <option value=""> Select a Writer </option>

                        @foreach ($writers as $writer)
                            <option value="{{ $writer->id }}" {{ $order->writer == $writer->id ? 'selected' : '' }}>
                                {{ $writer->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @else 
            <select name="writer" id="writer-{{ $order->id }}" hidden>
                @php
                $writers = \App\Models\user::where('type', 'Writer')->get();
                @endphp
                <option value=""> Select a Writer </option>
                    @foreach ($writers as $writer)
                        <option value="{{ $writer->id }}" {{ $order->writer == $writer->id ? 'selected' : '' }}>
                            {{ $writer->full_name }}
                        </option>
                    @endforeach
            </select>
        @endif 
    </div>

    <div class="flex items-center justify-end p-6 gap-3">
        <button type="button" x-on:click="modalIsOpen = false"
            class="px-4 py-2.5 bg-white text-gray-700 rounded-lg border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors font-medium">
            Cancel
        </button>
        <button type="submit" id="submit-button"
            class="px-5 py-2.5 bg-[#BCEC88] hover:bg-[#BCEC88]/90 focus:ring-4 focus:ring-[#BCEC88]/30 focus:outline-none text-[#5D7B2B] font-medium rounded-lg transition-colors flex items-center">
            Update Details
        </button>
    </div>
</form>
