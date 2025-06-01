<form action="{{ route('coupon.store') }}" method="POST">

    <form action="{{ route('coupon.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="p-6 space-y-4">
            <div>
                <label for="create-coupon" class="block text-sm font-medium text-gray-700 mb-2">
                    Coupon Code
                </label>
                <input type="text" id="create-coupon" name="coupon" value="{{ old('coupon') }}" required
                    maxlength="7"
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Enter coupon code">
            </div>

            <div>
                <label for="price-new" class="block text-sm font-medium text-gray-700 mb-2">
                    Discount Amount (%)
                </label>
                <input type="number" id="price-new" name="price" value="{{ old('price', 10) }}" required
                    min="1" max="100"
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border"
                    placeholder="Enter discount percentage">
            </div>

            <div>
                <label for="start_date-new" class="block text-sm font-medium text-gray-700 mb-2">
                    Start Date
                </label>
                <input type="date" id="start_date-new" name="start_date"
                    value="{{ old('start_date', date('Y-m-d')) }}" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
            </div>

            <div>
                <label for="end_date-new" class="block text-sm font-medium text-gray-700 mb-2">
                    End Date
                </label>
                <input type="date" id="end_date-new" name="end_date"
                    value="{{ old('end_date', date('Y-m-d', strtotime('+30 days'))) }}" required
                    class="w-full rounded-lg border-gray-300 py-3 px-3 text-gray-700 focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] appearance-none border">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    One-Time Use
                </label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="one_time" value="1" class="sr-only peer"
                        {{ old('one_time', 0) == 1 ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-[#BCEC88]/30 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#BCEC88]">
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
                Create Coupon
            </button>
        </div>
    </form>
