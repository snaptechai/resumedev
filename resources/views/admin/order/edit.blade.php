<div id="edit-{{ $Order->id }}" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all"> 
        <div class="flex items-center justify-between p-5 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Edit Order
            </h3>
            <button type="button" onclick="closeModal('edit-{{ $Order->id }}')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        
        <form action="{{ route('order.update', $Order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 gap-6"> 
             
                    <div>
                        <label for="writer_id-{{ $Order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Writer</label>
                        <select name="writer_id" id="writer_id-{{ $Order->id }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm p-3 dark:bg-gray-700 dark:text-white">
                            <option value="" disabled {{ is_null($Order->writer_id) ? 'selected' : '' }}>Select a Writer</option>
                            @foreach($writers as $writer)
                                <option value="{{ $writer->id }}" {{ $Order->writer_id == $writer->id ? 'selected' : '' }}>
                                    {{ $writer->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
             
                    <div>
                        <label for="payment_status-{{ $Order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Status</label>
                        <select name="payment_status" id="payment_status-{{ $Order->id }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm p-3 dark:bg-gray-700 dark:text-white">
                            <option value="Pending" {{ $Order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Success" {{ $Order->payment_status == 'Success' ? 'selected' : '' }}>Success</option>
                            <option value="Failed" {{ $Order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
             
                    <div>
                        <label for="order_status-{{ $Order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order Status</label>
                        <select name="order_status" id="order_status-{{ $Order->id }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm p-3 dark:bg-gray-700 dark:text-white">
                            <option value="1" {{ $Order->order_status == '1' ? 'selected' : '' }}>Pending</option>
                            <option value="2" {{ $Order->order_status == '2' ? 'selected' : '' }}>Completed</option>
                            <option value="3" {{ $Order->order_status == '3' ? 'selected' : '' }}>Accepted</option>
                            <option value="4" {{ $Order->order_status == '4' ? 'selected' : '' }}>Cancelled</option>
                            <option value="5" {{ $Order->order_status == '5' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
             
                    <div>
                        <label for="end_date-{{ $Order->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                        @php
                        $formattedEndDate = '';
                        try {
                            if ($Order->end_date) {
                                $formattedEndDate = \Carbon\Carbon::parse($Order->end_date)->format('Y-m-d\TH:i');
                            }
                        } catch (\Exception $e) {
                            $formattedEndDate = '';
                        }
                    @endphp

                    <input type="datetime-local" name="end_date" id="end_date-{{ $Order->id }}" value="{{ $formattedEndDate }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm p-3 dark:bg-gray-700 dark:text-white">
                    </div>
            
                </div>
            </div>
             
            <div class="flex items-center justify-end p-5 border-t dark:border-gray-700 gap-3">
                <button 
                    type="button" 
                    onclick="closeModal('edit-{{ $Order->id }}')" 
                    class="px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2.5 bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 focus:outline-none text-white font-medium rounded-lg transition-colors"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>