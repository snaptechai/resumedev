<x-layouts.app>
    <div class="w-full">
        <div class="bg-white rounded-xl overflow-hidden mb-6 border border-gray-100">
            <div class="bg-[#f0f9e8] px-6 py-4 border-b border-gray-100 flex items-center">
                <div class="h-8 w-8 flex items-center justify-center bg-[#BCEC88]/20 rounded-lg mr-3">
                    <x-icon name="chat-bubble-oval-left" class="h-5 w-5 text-[#6b8f3b]" />
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Conversation</h2>
                {{-- <h2 class="px-6 text-xl font-semibold text-gray-800">{{$order->end_date}}</h2> --}}
                @if ($order->end_date && \Carbon\Carbon::hasFormat($order->end_date, 'Y-m-d H:i:s'))
                    <span class="ml-4 text-xl font-medium countdown-timer text-gray-600"
                        data-end="{{ \Carbon\Carbon::parse($order->end_date)->format('Y-m-d H:i:s') }}">
                        Loading...
                    </span>
                @else
                    <span class="ml-4 text-xl text-gray-400">No End Date</span>
                @endif
            </div>

            @include('admin.massage-bar')

            <div class="h-[550px] overflow-y-auto p-6 bg-white space-y-6" id="messages">
                <div class="bg-gray-50 rounded-xl p-5 border border-gray-200 mb-6 max-w-[700px] ml-auto">
                    <p class="font-medium text-gray-800 mb-4">
                        Please submit the requirements below to get the job started
                    </p>
                    <div class="mb-3">
                        <p class="font-medium text-gray-700">
                            <b>A.</b> Your target job title
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            (Place separate orders if you are targeting multiple industries)
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="font-medium text-gray-700">
                            <b>B.</b> Work experience
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            1. Company
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            2. Position
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            3. Period
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="font-medium text-gray-700">
                            <b>C.</b> Personal details
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            1. Address
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            2. Phone
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            3. Email
                        </p>
                    </div>
                    <div class="mb-3">
                        <p class="font-medium text-gray-700">
                            <b>D.</b> Education details
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            1. College/school/university
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            2. Course
                        </p>
                        <p class="text-sm text-gray-600 ml-5">
                            3. Year
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="font-medium text-gray-700">
                            <b>E.</b> Your current CV/Resume (If you have one)
                        </p>
                    </div>
                    <p id="copy-template-btn"
                        class="inline-flex items-center text-sm font-medium text-[#0D5438] hover:text-[#0D5438]/80 cursor-pointer">
                        <span id="copy-text">Copy this template to your clipboard</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" class="ml-1.5">
                            <g clip-path="url(#clip0_40000010_7890)">
                                <path
                                    d="M5.83301 8.056C5.83301 7.46655 6.06716 6.90125 6.48396 6.48445C6.90076 6.06765 7.46606 5.8335 8.05551 5.8335H15.2772C15.569 5.8335 15.858 5.89098 16.1277 6.00267C16.3973 6.11437 16.6423 6.27807 16.8487 6.48445C17.0551 6.69083 17.2188 6.93584 17.3305 7.20548C17.4422 7.47513 17.4997 7.76413 17.4997 8.056V15.2777C17.4997 15.5695 17.4422 15.8585 17.3305 16.1282C17.2188 16.3978 17.0551 16.6428 16.8487 16.8492C16.6423 17.0556 16.3973 17.2193 16.1277 17.331C15.858 17.4427 15.569 17.5002 15.2772 17.5002H8.05551C7.76365 17.5002 7.47464 17.4427 7.20499 17.331C6.93535 17.2193 6.69034 17.0556 6.48396 16.8492C6.27758 16.6428 6.11388 16.3978 6.00219 16.1282C5.89049 15.8585 5.83301 15.5695 5.83301 15.2777V8.056Z"
                                    stroke="#0D5438" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path
                                    d="M3.34333 13.9475C3.08779 13.8018 2.87523 13.5912 2.72715 13.3371C2.57906 13.0829 2.50071 12.7942 2.5 12.5V4.16667C2.5 3.25 3.25 2.5 4.16667 2.5H12.5C13.125 2.5 13.465 2.82083 13.75 3.33333"
                                    stroke="#0D5438" stroke-width="1.66667" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_40000010_7890">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </p>
                </div>

                <div class="pr-2">
                    <div class="flex justify-end mb-3">
                        <div class="max-w-[80%]">
                            <div class="bg-[#bcec88] p-4 rounded-xl">
                                <div class="text-base break-words leading-relaxed text-black">
                                    Thank you for choosing Resume Mansion! We've received your
                                    order. Please provide the requested information above, or
                                    simply submit your current resume and target job title. If you
                                    have any questions or need further assistance, please don't
                                    hesitate to reach out. We're here to help you every step of
                                    the way! Looking forward to working with you!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <div class="flex items-center mb-6">
                            <div class="flex flex-col">
                                <span class="font-medium text-sm text-green-800">
                                    System
                                </span>
                                <span class="text-xs text-gray-500 text-right">
                                    {{ date('M d, Y h:i A', strtotime($order->added_date)) }}
                                </span>
                            </div>
                            <div
                                class="w-8 h-8 rounded-full bg-[#BCEC88] text-black flex items-center justify-center text-sm font-semibold ml-2">
                                S
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.orders.partials.message-item', [
                    'formattedMessages' => $formattedMessages,
                    'templates' => $templates,
                    'templateCount' => $templateCount,
                    'order' => $order,
                ])
                {{-- @else
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center px-6 py-10 rounded-xl max-w-md mx-auto">
                            <x-icon name="chat-bubble-oval-left-ellipsis"
                                class="mx-auto h-16 w-16 text-gray-300 mb-4" />
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">No messages yet</h3>
                            <p class="text-gray-500 text-sm mb-4">Send a message to start the conversation</p>
                        </div>
                    </div>
                @endif --}}
            </div>

            <div class="p-6 border-t border-gray-100 bg-gray-50">
                <div class="mb-4">
                    <div class="flex items-center mb-3">
                        <div class="h-5 w-5 flex items-center justify-center bg-[#BCEC88]/20 rounded-lg mr-2">
                            <x-icon name="bolt" class="h-3 w-3 text-[#6b8f3b]" />
                        </div>
                        <h4 class="text-sm font-medium text-gray-700">Quick Actions</h4>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                            class="quick-action-btn inline-flex items-center px-3 py-1.5 text-sm font-medium text-[#5D7B2B] bg-[#BCEC88]/20 rounded-md hover:bg-[#BCEC88]/30 transition-colors"
                            data-message="Please tell us your preferred template from the options below.">
                            <x-icon name="document-text" class="h-4 w-4 mr-1.5" />
                            Request Template Choice
                        </button>
                    </div>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="inline-flex items-center">
                            <x-icon name="light-bulb" class="h-3 w-3 mr-1" />
                            Tip: When requesting templates, the system will automatically show available options to the
                            user
                        </span>
                    </div>
                </div>

                <form action="{{ route('orders.message', $order->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <div class="relative">
                        <textarea id="message-input" name="message" rows="3"
                            class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#BCEC88] focus:border-[#BCEC88] focus:outline-none transition"
                            placeholder="Type your message here..."></textarea>
                        <button type="button" id="emoji-button"
                            class="absolute right-3 bottom-3 text-gray-500 hover:text-gray-700 transition-colors cursor-pointer">
                            <x-icon name="face-smile" class="h-6 w-6" />
                        </button>
                        <div id="emoji-picker-container" class="absolute right-8 bottom-8 z-10"></div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <label for="attachment"
                                class="inline-flex items-center px-3.5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none cursor-pointer transition">
                                <x-icon name="paper-clip" class="h-5 w-5 text-gray-500 mr-2" />
                                Attach File
                                <input id="attachment" name="attachment[]" type="file" class="hidden" multiple>
                            </label>
                            <span id="file-name" class="ml-3 text-sm text-gray-600 block break-words"></span>
                        </div>
                        <button type="submit" id="send-message-btn"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-[#5D7B2B] bg-[#BCEC88] border border-transparent rounded-lg shadow-sm transition duration-200 hover:bg-[#BCEC88]/90 focus:outline-none hover:cursor-pointer">
                            <span>Send Message</span>
                            <x-icon name="paper-airplane" class="h-5 w-5 ml-2" />
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-xl overflow-hidden border border-gray-100 mt-6">
            <div class="bg-[#f0f9e8] px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Admin Notes</h2>
                @if (auth()->user()->hasPermission('Edit Admin Notes'))
                    <div class="flex items-center space-x-2">
                        <form id="admin-note-upload-form" method="POST"
                            action="{{ route('order.admin-note.upload', $order->id) }}" enctype="multipart/form-data">
                            @csrf
                            <label for="admin_note_attachment"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                <x-icon name="paper-clip" class="h-4 w-4 mr-1.5 text-gray-500" />
                                Attach Files
                                <input id="admin_note_attachment" name="admin_note_attachment[]" type="file"
                                    multiple class="hidden" onchange="this.form.submit()">
                            </label>
                        </form>

                        <x-modal id="edit-note-edit-{{ $order->id }}">
                            <x-slot name="trigger">
                                <button x-on:click="modalIsOpen = true" type="button"
                                    class="whitespace-nowrap rounded-lg bg-[#BCEC88] border border-transparent px-4 py-2 text-sm font-medium tracking-wide text-[#000000] transition hover:bg-[#BCEC88]/90 focus:outline-none">
                                    <div class="flex items-center">
                                        <x-icon name="pencil-square" class="h-4 w-4 mr-1.5" />
                                        Edit Notes
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="header">
                                <h3 class="text-lg font-semibold">Edit Admin Notes</h3>
                            </x-slot>

                            <div class="p-4">
                                @include('admin.orders.note-edit', ['order' => $order])
                            </div>
                        </x-modal>
                    </div>
                @endif
            </div>

            <div class="p-6">
                @if ($order->admin_note)
                    <div class="w-full">
                        <div class="prose max-w-none">
                            {!! Purifier::clean($order->admin_note) !!}
                        </div>
                    </div>
                @else
                    <div class="text-center">
                        <x-icon name="rectangle-stack" class="w-10 text-gray-400 mx-auto mb-2" />
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No Admin Notes found</h3>
                        <p class="text-sm text-gray-500">There are no Admin Notes campaigns configured yet.</p>
                    </div>
                @endif
            </div>

            @if ($files->count())
                <div class="px-6 pb-4">
                    <h4 class="text-md font-semibold mb-2 text-gray-700">Attached Files</h4>
                    <ul class="space-y-1">
                        @foreach ($files as $file)
                            <li class="flex items-center text-sm text-gray-700">
                                <x-icon name="paper-clip" class="w-4 h-4 mr-2 text-gray-500" />

                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank"
                                    class="hover:underline hover:text-green-600" title="view">
                                    {{ basename($file->file_path) }}
                                </a>
                                <a href="{{ asset('storage/' . $file->file_path) }}" download
                                    class="ml-3 hover:underline hover:text-green-600" title="Download">
                                    <x-icon name="arrow-down-tray" class="w-4 h-4" />
                                </a>
                                <span class="ml-auto text-xs text-gray-900">
                                    {{ \Carbon\Carbon::parse($file->added_date)->format('Y-m-d') }}
                                </span>
                                @if (auth()->user()->hasPermission('Edit Admin Notes'))
                                    <form action="{{ route('order.admin-note.file.delete', [$order->id, $file->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this file?');"
                                        class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-700 hover:underline hover:text-red-400 cursor-pointer"
                                            title="Delete">
                                            <x-icon name="trash" class="w-4 h-4" />
                                        </button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <div class="bg-white rounded-xl overflow-hidden border border-gray-100 mt-6">
            <div class="bg-[#f0f9e8] px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Order Details</h2>
                <x-modal id="edit-order-{{ $order->id }}">
                    <x-slot name="trigger">
                        <button x-on:click="modalIsOpen = true" type="button"
                            class="whitespace-nowrap rounded-lg bg-[#BCEC88] border border-transparent px-4 py-2 text-sm font-medium tracking-wide text-[#5D7B2B] transition hover:bg-[#BCEC88]/90 text-center focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#BCEC88] active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed">
                            <div class="flex items-center">
                                <x-icon name="pencil-square" class="h-4 w-4 mr-1.5" />
                                Edit Details
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="header">
                        <h3 class="text-lg font-semibold">
                            Edit Order Details
                        </h3>
                    </x-slot>

                    <div class="p-4">
                        @include('admin.orders.edit', ['order' => $order])
                    </div>
                </x-modal>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <div class="p-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase">Order Information</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Order Number</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ 'RM' . sprintf('%06d', $order->id) }}</span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Express Service</span>
                                    <span class="text-sm font-medium">
                                        @if ($order->express == 1)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Yes</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">No</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Date Ordered</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ date('M d, Y', strtotime($order->added_date)) }}</span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Due Date</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ date('M d, Y', strtotime($order->end_date)) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <div class="p-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase">Order Status</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Current Status</span>
                                    <span class="text-sm font-medium">
                                        @php
                                            $statusMap = [
                                                1 => ['class' => 'bg-yellow-100 text-yellow-800'],
                                                2 => ['class' => 'bg-green-100 text-green-800'],
                                                3 => ['class' => 'bg-blue-100 text-blue-800'],
                                                4 => ['class' => 'bg-red-100 text-red-800'],
                                                5 => ['class' => 'bg-red-100 text-red-800'],
                                            ];
                                            $orderStatus = \App\Models\OrderSetp::find($order->order_status);
                                            $statusColor =
                                                $statusMap[$order->order_status]['class'] ??
                                                'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                            {{ $orderStatus ? $orderStatus->step : 'Unknown' }}
                                        </span>
                                    </span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Assigned Writer</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $order->assignedWriter?->full_name ?? 'Not assigned' }}</span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Last Modified</span>
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $order->last_modified_date ? date('M d, Y', strtotime($order->last_modified_date)) : 'N/A' }}
                                    </span>
                                </div>
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Modified By</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $order->last_modified_by ?: 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @if (auth()->user()->hasPermission('View order price & details'))
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="p-4 bg-gray-50 border-b border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700 uppercase">Payment Information</h3>
                                </div>
                                <div class="divide-y divide-gray-200">
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="text-sm text-gray-500">Payment Status</span>
                                        <span class="text-sm font-medium">
                                            @if ($order->payment_status == 'Success')
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Success</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">{{ ucfirst($order->payment_status) }}</span>
                                            @endif
                                        </span>
                                    </div>
                                    @if (isset($paymentDetails) && $paymentDetails->transaction_id)
                                        <div class="flex justify-between py-3 px-4">
                                            <span class="text-sm text-gray-500">Transaction ID</span>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ $paymentDetails->transaction_id }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="text-sm text-gray-500">Total Amount</span>
                                        <span
                                            class="text-sm font-medium text-green-600">{{ $order->total_price }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="text-sm text-gray-500">Currency</span>
                                        <span
                                            class="text-sm font-medium text-gray-900 uppercase">{{ $order->currency }}</span>
                                    </div>
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="text-sm text-gray-500">Coupon Applied</span>
                                        <span class="text-sm font-medium">
                                            @if ($order->couponTable)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $order->couponTable->coupon }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">None</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <div class="p-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase">Customer Information</h3>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="flex justify-between py-3 px-4">
                                    <span class="text-sm text-gray-500">Customer ID</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $order->uid }}</span>
                                </div>
                                @if (isset($customer))
                                    <div class="flex justify-between py-3 px-4">
                                        <span class="text-sm text-gray-500">Customer Name</span>
                                        <span
                                            class="text-sm font-medium text-gray-900">{{ $customer->full_name }}</span>
                                    </div>

                                    @if (auth()->user()->hasPermission('View order price & details'))
                                        <div class="flex justify-between py-3 px-4">
                                            <span class="text-sm text-gray-500">Customer Email</span>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ $customer->username }}</span>
                                        </div>
                                        <div class="flex justify-between py-3 px-4">
                                            <span class="text-sm text-gray-500">Customer Mobile</span>
                                            <span
                                                class="text-sm font-medium text-gray-900">{{ $customer->contact_no }}</span>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl overflow-hidden mt-6 border border-gray-100">
            <div class="bg-[#f0f9e8] px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Package & Addons</h2>
            </div>

            <div class="p-6">
                @php
                    $package = \App\Models\Package::find($order->package_id);
                    $orderPackages = \App\Models\OrderPackage::where('oid', $order->id)->get();
                @endphp

                @if ($package)
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 flex items-center justify-center bg-[#BCEC88]/20 rounded-lg mr-3">
                                <x-icon name="cube" class="h-6 w-6 text-[#6b8f3b]" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">Main Package</h3>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <div
                                class="flex flex-col md:flex-row md:items-center justify-between p-5 border-b border-gray-200">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800">{{ $package->title }}</h4>
                                    <div class="flex items-center mt-1">
                                        <span class="text-sm text-gray-600 mr-4">Duration: <span
                                                class="font-medium">{{ $package->duration }}</span></span>
                                        @if (auth()->user()->hasPermission('View order price & details'))
                                            <span class="text-sm text-gray-600">Price: <span
                                                    class="font-medium text-green-600">${{ $package->price }}</span></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-3 md:mt-0">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Base Package
                                    </span>
                                </div>
                            </div>

                            @if ($package->short_description)
                                <div class="px-5 py-4 bg-gray-50 border-b border-gray-200">
                                    <h5 class="text-sm font-medium text-gray-700 mb-2">Description</h5>
                                    <div class="text-sm text-gray-600 prose max-w-none">
                                        {!! $package->short_description !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if (count($orderPackages) > 0)
                    <div>
                        <div class="flex items-center mb-4">
                            <div class="h-10 w-10 flex items-center justify-center bg-blue-100 rounded-lg mr-3">
                                <x-icon name="puzzle-piece" class="h-6 w-6 text-blue-600" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-800">Addons</h3>
                        </div>

                        <div
                            class="overflow-hidden rounded-lg border border-gray-200 divide-y divide-gray-200 shadow-sm">
                            @foreach ($orderPackages as $orderPackage)
                                @php
                                    $addon = \App\Models\Addon::find($orderPackage->addon_id);
                                @endphp

                                @if ($addon)
                                    <div class="p-5 bg-white hover:bg-gray-50 transition-colors">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                                            <div class="mb-3 md:mb-0">
                                                <h4 class="text-base font-medium text-gray-800">{{ $addon->title }}
                                                </h4>
                                                <p class="text-sm text-gray-600 mt-1">{{ $addon->description }}</p>
                                            </div>
                                            <div class="flex flex-col md:flex-row md:items-center">
                                                <div
                                                    class="bg-gray-100 px-3 py-1.5 rounded-md text-gray-700 text-sm mr-4 mb-2 md:mb-0">
                                                    <span class="font-medium">Qty:
                                                        {{ $orderPackage->quantity }}</span>
                                                </div>
                                                @if (auth()->user()->hasPermission('View order price & details'))
                                                    <div class="text-right">
                                                        <span class="text-sm text-gray-500">Price per unit</span>
                                                        <p class="text-base font-medium text-green-600">
                                                            ${{ $addon->price }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-3 pt-3 border-t border-gray-100 flex justify-between">
                                            <span class="text-sm text-gray-600">Added on
                                                {{ date('M d, Y', strtotime($orderPackage->created_at)) }}</span>
                                            @if (auth()->user()->hasPermission('View order price & details'))
                                                <span class="font-medium text-gray-900">Subtotal:
                                                    ${{ number_format($orderPackage->quantity * $addon->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <div class="h-12 w-12 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                            <x-icon name="puzzle-piece" class="h-6 w-6 text-gray-400" />
                        </div>
                        <h4 class="text-base font-medium text-gray-700 mb-1">No Addons Selected</h4>
                        <p class="text-sm text-gray-500">This order doesn't include any additional addons.</p>
                    </div>
                @endif

                @if (auth()->user()->hasPermission('View order price & details'))
                    <div class="mt-8 bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Summary</h3>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Base Package</span>
                                <span class="font-medium">${{ $package ? $package->price : '0.00' }}</span>
                            </div>

                            @if (count($orderPackages) > 0)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Addons</span>
                                    <span
                                        class="font-medium">${{ $orderPackages->sum(function ($item) {
                                            $addon = \App\Models\Addon::find($item->addon_id);
                                            return $item->quantity * ($addon ? $addon->price : 0);
                                        }) }}</span>
                                </div>
                            @endif

                            @if ($order->couponTable)
                                @php
                                    $coupon = \App\Models\Coupon::where('id', $order->coupon)->first();
                                    $totalPrice =
                                        count($orderPackages) > 0
                                            ? $orderPackages->sum(function ($item) {
                                                return $item->quantity * $item->price;
                                            })
                                            : 0;
                                    $totalPrice += $package ? $package->price : 0;
                                    $discountAmount = ($totalPrice * $coupon->price) / 100;
                                @endphp
                                <div class="flex justify-between text-green-600">
                                    <span>Coupon Discount</span>
                                    <span>-${{ number_format($discountAmount, 2) }}</span>
                                </div>
                            @endif

                            <div class="border-t border-gray-200 pt-3 mt-3">
                                <div class="flex justify-between font-semibold text-gray-900">
                                    <span>Total</span>
                                    <span>${{ $order->total_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('attachment').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : '';
            document.getElementById('file-name').textContent = fileName;
        });

        window.onload = function() {
            const messagesContainer = document.getElementById('messages');
            if (messagesContainer) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            const textarea = document.getElementById('message-input');
            const emojiButton = document.getElementById('emoji-button');
            const emojiPickerContainer = document.getElementById('emoji-picker-container');

            let pickerVisible = false;

            const pickerOptions = {
                theme: 'light',
                parent: emojiPickerContainer,
                onEmojiSelect: function(emoji) {
                    const start = textarea.selectionStart;
                    const end = textarea.selectionEnd;
                    const text = textarea.value;

                    textarea.value = text.substring(0, start) + emoji.native + text.substring(end);
                    textarea.selectionStart = textarea.selectionEnd = start + emoji.native.length;
                    textarea.focus();
                }

            };

            emojiPickerContainer.style.display = 'none';

            new EmojiMart.Picker(pickerOptions);

            emojiButton.addEventListener('click', function() {
                pickerVisible = !pickerVisible;
                emojiPickerContainer.style.display = pickerVisible ? 'block' : 'none';
            });
            document.addEventListener('click', function(event) {
                if (!emojiButton.contains(event.target) && !emojiPickerContainer.contains(event.target)) {
                    pickerVisible = false;
                    emojiPickerContainer.style.display = 'none';
                }
            });

            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.shiftKey) {
                    e.preventDefault();
                    const form = textarea.closest('form');
                    if (textarea.value.trim() !== '') {
                        form.submit();
                    }
                }
            });

            document.querySelector('form[action*="orders.message"]').addEventListener('submit', function(e) {
                const messageInput = this.querySelector('#message-input');
                const fileInput = this.querySelector('#attachment');

                if (messageInput.value.trim() === '' && (!fileInput.files || fileInput.files.length === 0)) {
                    e.preventDefault();
                    alert('Please provide either a message or an attachment.');
                }
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const quickActionButtons = document.querySelectorAll('.quick-action-btn');
            const messageInput = document.getElementById('message-input');

            quickActionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const message = this.getAttribute('data-message');
                    messageInput.value = message;
                    messageInput.focus();
                });
            });
        });

        function autoResize(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 1.5 * 16 * 10) + 'px';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea[readonly]');
            if (textarea) autoResize(textarea);
        });

        document.addEventListener('DOMContentLoaded', () => {
            const textarea = document.getElementById('admin_note');
            if (textarea) autoResize(textarea);

            const copyTemplateBtn = document.getElementById('copy-template-btn');
            const copyText = document.getElementById('copy-text');

            if (copyTemplateBtn) {
                copyTemplateBtn.addEventListener('click', function() {
                    const templateText = `
A. Your target job title
(Place separate orders if you are targeting multiple industries)

B. Work experience
1. Company
2. Position
3. Period

C. Personal details
1. Address
2. Phone
3. Email

D. Education details
1. College/school/university
2. Course
3. Year

E. Your current CV/Resume (If you have one)`.trim();

                    navigator.clipboard.writeText(templateText).then(() => {
                        copyText.textContent = "Copied!";
                        setTimeout(() => {
                            copyText.textContent = "Copy this template to your clipboard";
                        }, 2000);
                    }).catch(err => {
                        console.error('Could not copy text: ', err);
                    });
                });
            }
        });
    </script>
</x-layouts.app>

<script>
    document.getElementById('attachment').addEventListener('change', function() {
        const fileNameSpan = document.getElementById('file-name');
        const files = Array.from(this.files);

        if (files.length > 0) {
            const names = files.map(file => file.name).join(', ');
            fileNameSpan.textContent = names;
        } else {
            fileNameSpan.textContent = '';
        }
    });

    function startCountdown(el, endTimeStr) {
        const end = new Date(endTimeStr + 'Z').getTime();

        function update() {
            const now = new Date().getTime();
            const distance = end - now;

            if (distance <= 0) {
                el.textContent = 'Overdue';
                el.classList.remove('text-gray-600');
                el.classList.add('text-red-600', 'font-medium');
                return;
            }

            const totalHours = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (totalHours <= 12) {
                el.classList.remove('text-gray-600');
                el.classList.add('text-red-600', 'font-medium');
            } else {
                el.classList.remove('text-red-600', 'font-medium');
                el.classList.add('text-gray-600');
            }

            const formatted =
                `${totalHours.toString().padStart(2, '0')}:` +
                `${minutes.toString().padStart(2, '0')}:` +
                `${seconds.toString().padStart(2, '0')}` + ' left';

            el.textContent = formatted;
            setTimeout(update, 1000);
        }

        update();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.countdown-timer').forEach(el => {
            const end = el.dataset.end;
            if (end) {
                startCountdown(el, end);
            }
        });
    });
</script>
<script>
    let refreshInterval;
    let isRefreshing = false;
    let lastMessageId = null;

    function isUserAtBottom() {
        const container = document.getElementById('messages');
        return container.scrollHeight - container.scrollTop <= container.clientHeight + 50;
    }

    function refreshMessages() {
        if (isRefreshing) return;

        isRefreshing = true;
        const orderId = '{{ $order->id }}';
        const wasAtBottom = isUserAtBottom();

        const url = lastMessageId ?
            `/admin/orders/${orderId}/getmessages?last_message_id=${lastMessageId}` :
            `/admin/orders/${orderId}/getmessages`;

        fetch(url, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.hasNewMessages) {
                    const messagesContainer = document.getElementById('messages');

                    messagesContainer.insertAdjacentHTML('beforeend', data.html);

                    lastMessageId = data.lastMessageId;

                    if (wasAtBottom) {
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }
                }
            })
            .catch(error => {
                console.error('Error refreshing messages:', error);
            })
            .finally(() => {
                isRefreshing = false;
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const messagesContainer = document.getElementById('messages');
        if (messagesContainer) {
            const messages = messagesContainer.querySelectorAll('[data-message-id]');
            if (messages.length > 0) {
                lastMessageId = messages[messages.length - 1].getAttribute('data-message-id');
            }
        }

        refreshInterval = setInterval(refreshMessages, 10000);
    });

    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearInterval(refreshInterval);
        } else {
            refreshInterval = setInterval(refreshMessages, 10000);
        }
    });

    window.addEventListener('beforeunload', function() {
        clearInterval(refreshInterval);
    });
</script>
