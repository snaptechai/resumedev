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
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"
            class="ml-1.5">
            <g clip-path="url(#clip0_40000010_7890)">
                <path
                    d="M5.83301 8.056C5.83301 7.46655 6.06716 6.90125 6.48396 6.48445C6.90076 6.06765 7.46606 5.8335 8.05551 5.8335H15.2772C15.569 5.8335 15.858 5.89098 16.1277 6.00267C16.3973 6.11437 16.6423 6.27807 16.8487 6.48445C17.0551 6.69083 17.2188 6.93584 17.3305 7.20548C17.4422 7.47513 17.4997 7.76413 17.4997 8.056V15.2777C17.4997 15.5695 17.4422 15.8585 17.3305 16.1282C17.2188 16.3978 17.0551 16.6428 16.8487 16.8492C16.6423 17.0556 16.3973 17.2193 16.1277 17.331C15.858 17.4427 15.569 17.5002 15.2772 17.5002H8.05551C7.76365 17.5002 7.47464 17.4427 7.20499 17.331C6.93535 17.2193 6.69034 17.0556 6.48396 16.8492C6.27758 16.6428 6.11388 16.3978 6.00219 16.1282C5.89049 15.8585 5.83301 15.5695 5.83301 15.2777V8.056Z"
                    stroke="#0D5438" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M3.34333 13.9475C3.08779 13.8018 2.87523 13.5912 2.72715 13.3371C2.57906 13.0829 2.50071 12.7942 2.5 12.5V4.16667C2.5 3.25 3.25 2.5 4.16667 2.5H12.5C13.125 2.5 13.465 2.82083 13.75 3.33333"
                    stroke="#0D5438" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round" />
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
                    {{ date('M d, Y h:i A', strtotime($order->added_date ?? now())) }}
                </span>
            </div>
            <div
                class="w-8 h-8 rounded-full bg-[#BCEC88] text-black flex items-center justify-center text-sm font-semibold ml-2">
                S
            </div>
        </div>
    </div>
</div>

@foreach ($formattedMessages as $msg)
    @if ($msg['message'] == 'you submitted the requirements')
        <div class="flex items-start mb-3 justify-center">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="flex-shrink-0">
                <g clip-path="url(#clip0_208_18483)">
                    <circle cx="22" cy="22" r="22" fill="#DDF2F9" />
                    <g clip-path="url(#clip1_208_18483)">
                        <path
                            d="M14 30H18L28.5 19.5C28.7626 19.2374 28.971 18.9255 29.1131 18.5824C29.2553 18.2392 29.3284 17.8714 29.3284 17.5C29.3284 17.1286 29.2553 16.7608 29.1131 16.4176C28.971 16.0744 28.7626 15.7626 28.5 15.5C28.2374 15.2374 27.9256 15.029 27.5824 14.8869C27.2392 14.7447 26.8714 14.6716 26.5 14.6716C26.1286 14.6716 25.7608 14.7447 25.4176 14.8869C25.0744 15.029 24.7626 15.2374 24.5 15.5L14 26V30Z"
                            stroke="#1760B2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M23.5 16.5L27.5 20.5" stroke="#1760B2" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_208_18483">
                        <rect width="44" height="44" fill="white" />
                    </clipPath>
                    <clipPath id="clip1_208_18483">
                        <rect width="24" height="24" fill="white" transform="translate(10 10)" />
                    </clipPath>
                </defs>
            </svg>
            <div class="ml-3">
                <span class="text-sm font-medium text-gray-600 block">User submitted the
                    requirements</span>
                <span class="text-xs text-gray-500">{{ $msg['created_at'] }}</span>
            </div>
        </div>
    @elseif ($msg['message'] == 'your order started')
        <div class="flex items-start mb-3 justify-center">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="flex-shrink-0">
                <g clip-path="url(#clip0_208_18499)">
                    <circle cx="22" cy="22" r="22" fill="#FFDFFA" />
                    <g clip-path="url(#clip1_208_18499)">
                        <path
                            d="M14 23C15.7831 23.2119 17.443 24.0175 18.7128 25.2872C19.9825 26.557 20.7881 28.2169 21 30C21.8839 29.4904 22.6233 28.7638 23.1482 27.8889C23.6732 27.014 23.9663 26.0197 24 25C25.6791 24.4093 27.1454 23.334 28.2133 21.91C29.2813 20.486 29.9031 18.7773 30 17C30 16.2044 29.6839 15.4413 29.1213 14.8787C28.5587 14.3161 27.7956 14 27 14C25.2227 14.0969 23.514 14.7187 22.09 15.7867C20.666 16.8546 19.5907 18.3209 19 20C17.9803 20.0337 16.986 20.3268 16.1111 20.8518C15.2362 21.3767 14.5096 22.1161 14 23Z"
                            stroke="#C415B5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M17.0005 24C15.9597 24.5876 15.1181 25.4726 14.5836 26.5416C14.0491 27.6106 13.8461 28.8148 14.0005 30C15.1856 30.1544 16.3899 29.9513 17.4589 29.4168C18.5279 28.8823 19.4129 28.0408 20.0005 27"
                            stroke="#C415B5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M24 19C24 19.2652 24.1054 19.5196 24.2929 19.7071C24.4804 19.8946 24.7348 20 25 20C25.2652 20 25.5196 19.8946 25.7071 19.7071C25.8946 19.5196 26 19.2652 26 19C26 18.7348 25.8946 18.4804 25.7071 18.2929C25.5196 18.1054 25.2652 18 25 18C24.7348 18 24.4804 18.1054 24.2929 18.2929C24.1054 18.4804 24 18.7348 24 19Z"
                            stroke="#C415B5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_208_18499">
                        <rect width="44" height="44" fill="white" />
                    </clipPath>
                    <clipPath id="clip1_208_18499">
                        <rect width="24" height="24" fill="white" transform="translate(10 10)" />
                    </clipPath>
                </defs>
            </svg>
            <div class="ml-3">
                <span class="text-sm font-medium text-gray-600 block">Order started</span>
                <span class="text-xs text-gray-500">{{ $msg['created_at'] }}</span>
            </div>
        </div>
    @elseif ($msg['message'] == 'your order delivered')
        <div class="flex items-start mb-3 justify-center">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0">
                <g clip-path="url(#clip0_208_18583)">
                    <circle cx="22" cy="22" r="22" fill="#D7F6C3" />
                    <g clip-path="url(#clip1_208_18583)">
                        <path
                            d="M15 27C15 27.5304 15.2107 28.0391 15.5858 28.4142C15.9609 28.7893 16.4696 29 17 29C17.5304 29 18.0391 28.7893 18.4142 28.4142C18.7893 28.0391 19 27.5304 19 27C19 26.4696 18.7893 25.9609 18.4142 25.5858C18.0391 25.2107 17.5304 25 17 25C16.4696 25 15.9609 25.2107 15.5858 25.5858C15.2107 25.9609 15 26.4696 15 27Z"
                            stroke="#063B26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M25 27C25 27.5304 25.2107 28.0391 25.5858 28.4142C25.9609 28.7893 26.4696 29 27 29C27.5304 29 28.0391 28.7893 28.4142 28.4142C28.7893 28.0391 29 27.5304 29 27C29 26.4696 28.7893 25.9609 28.4142 25.5858C28.0391 25.2107 27.5304 25 27 25C26.4696 25 25.9609 25.2107 25.5858 25.5858C25.2107 25.9609 25 26.4696 25 27Z"
                            stroke="#063B26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M15 27H13V23M12 15H23V27M19 27H25M29 27H31V21M31 21H23M31 21L28 16H23"
                            stroke="#063B26" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13 19H17" stroke="#063B26" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_208_18583">
                        <rect width="44" height="44" fill="white" />
                    </clipPath>
                    <clipPath id="clip1_208_18583">
                        <rect width="24" height="24" fill="white" transform="translate(10 10)" />
                    </clipPath>
                </defs>
            </svg>
            <div class="ml-3">
                <span class="text-sm font-medium text-gray-600 block">Order delivered</span>
                <span class="text-xs text-gray-500">{{ $msg['created_at'] }}</span>
            </div>
        </div>
    @elseif (strpos($msg['message'], 'addon added:') === 0)
        <div class="flex items-start mb-3 justify-center">
            <div class="h-10 w-10 flex items-center justify-center bg-[#FFF1E5] rounded-full flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#E67E22" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z" />
                </svg>
            </div>
            <div class="ml-3">
                <span class="text-sm font-medium text-gray-600 block">
                    {{ str_replace('addon added: ', 'Addon added: ', $msg['message']) }}
                </span>
                <span class="text-xs text-gray-500">{{ $msg['created_at'] }}</span>
            </div>
        </div>
    @elseif ($msg['message'] == 'you requested revision')
        <div class="flex items-start mb-3 justify-center">
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_208_18602)">
                    <circle cx="22" cy="22" r="22" fill="#FFE7D3" />
                    <g clip-path="url(#clip1_208_18602)">
                        <path
                            d="M25.0001 14.55C24.0217 14.156 22.9754 13.9586 21.9207 13.969C20.8661 13.9794 19.8238 14.1975 18.8535 14.6107C17.8831 15.0239 17.0036 15.6242 16.2652 16.3773C15.5269 17.1305 14.9441 18.0216 14.5501 19C13.7544 20.9758 13.7763 23.1868 14.6108 25.1466C15.4454 27.1064 17.0242 28.6543 19.0001 29.45M19.0001 25V30H14.0001"
                            stroke="#B03200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M28.3701 17.16V17.17" stroke="#B03200" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M23 29.94V29.95" stroke="#B03200" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M26.8398 28.37V28.38" stroke="#B03200" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M29.3701 25.1V25.11" stroke="#B03200" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M29.9404 21V21.01" stroke="#B03200" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_208_18602">
                        <rect width="44" height="44" fill="white" />
                    </clipPath>
                    <clipPath id="clip1_208_18602">
                        <rect width="24" height="24" fill="white" transform="translate(10 10)" />
                    </clipPath>
                </defs>
            </svg>
            <div class="ml-3">
                <span class="text-sm font-medium text-gray-600 block">You requested revision</span>
                <span class="text-xs text-gray-500">{{ $msg['created_at'] }}</span>
            </div>
        </div>
    @else
        <div class="{{ $msg['side'] === 'left' ? 'pl-2' : 'pr-2' }}">
            <div class="flex {{ $msg['side'] === 'left' ? '' : 'justify-end' }} mb-3">
                <div class="max-w-[80%]">
                    <div class="{{ $msg['side'] === 'left' ? 'bg-[#f5f6f4]' : 'bg-[#bcec88]' }} p-4 rounded-xl">
                        <div class="text-base break-words leading-relaxed text-black">
                            @if (!empty(trim($msg['message'])))
                                {!! Purifier::clean($msg['message']) !!}
                            @endif
                        </div>
                        @if ($msg['show_templates'])
                            <div class="mt-4">
                                <div class="border-t border-gray-100 pt-4">
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                        @foreach ($templates->take(3) as $template)
                                            <div
                                                class="group relative bg-[#f0f9e8] rounded-lg overflow-hidden border border-[#BCEC88]/20 hover:border-[#BCEC88]/60 transition-colors">
                                                <div class="relative aspect-[3/4]">
                                                    <a href="{{ asset('storage/' . $template->image) }}"
                                                        target="_blank" class="block">
                                                        <img src="{{ asset('storage/' . $template->image) }}"
                                                            alt="{{ $template->identifier }}"
                                                            class="absolute inset-0 w-full h-full object-cover cursor-pointer">
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-t from-[#5D7B2B]/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                                        </div>
                                                    </a>
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 p-3 bg-white/95 border-t border-[#BCEC88]/20">
                                                    <p class="text-sm font-medium text-[#5D7B2B]">
                                                        {{ $template->identifier }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if ($templateCount > 3)
                                        <div class="text-center mt-4">
                                            <x-modal name="view-all-templates">
                                                <x-slot name="trigger">
                                                    <button type="button" x-on:click="modalIsOpen = true"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-[#5D7B2B] hover:text-[#5D7B2B]/80">
                                                        <x-icon name="squares-2x2" class="h-4 w-4 mr-1.5" />
                                                        View all {{ $templateCount }} templates
                                                    </button>
                                                </x-slot>

                                                <x-slot name="header">
                                                    <div class="flex items-center">
                                                        <h3 class="text-lg font-semibold text-[#5D7B2B]">
                                                            Available Templates
                                                        </h3>
                                                    </div>
                                                </x-slot>

                                                <div class="p-4">
                                                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                                                        @foreach ($templates as $template)
                                                            <div
                                                                class="group relative bg-[#f0f9e8] rounded-lg overflow-hidden border border-[#BCEC88]/20 hover:border-[#BCEC88]/60 transition-colors">
                                                                <div class="relative aspect-[3/4]">
                                                                    <a href="{{ asset('storage/' . $template->image) }}"
                                                                        target="_blank" class="block">
                                                                        <img src="{{ asset('storage/' . $template->image) }}"
                                                                            alt="{{ $template->identifier }}"
                                                                            class="absolute inset-0 w-full h-full object-cover cursor-pointer">
                                                                        <div
                                                                            class="absolute inset-0 bg-gradient-to-t from-[#5D7B2B]/40 via-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="absolute bottom-0 left-0 right-0 p-3 bg-white/95 border-t border-[#BCEC88]/20">
                                                                    <p class="text-sm font-medium text-[#5D7B2B]">
                                                                        {{ $template->identifier }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </x-modal>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if (count($msg['attachments']) > 0)
                            <div
                                class=" {{ !empty(trim($msg['message'])) ? 'border-t border-gray-100 mt-3 pt-2' : '' }}">
                                @foreach ($msg['attachments'] as $attachment)
                                    @php
                                        $extension = pathinfo($attachment, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($extension), [
                                            'jpg',
                                            'jpeg',
                                            'png',
                                            'gif',
                                            'webp',
                                            'svg',
                                        ]);
                                    @endphp

                                    @if ($isImage)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $attachment) }}" alt="Attachment"
                                                class="max-w-full rounded-lg border border-gray-200 max-h-64 object-contain" />
                                            <a href="{{ asset('storage/' . $attachment) }}" target="_blank"
                                                class="inline-flex items-center px-2.5 py-1.5 mt-2 text-xs font-medium text-blue-700 bg-blue-50 border border-blue-100 rounded hover:bg-blue-100 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                </svg>
                                                @php
                                                    $filename = basename($attachment);
                                                    $displayName = preg_replace('/^\d+_/', '', $filename);
                                                @endphp
                                                {{ $displayName }}
                                            </a>
                                        </div>
                                    @elseif ($extension === 'pdf')
                                        <a href="{{ asset('storage/' . $attachment) }}" target="_blank"
                                            class="inline-flex items-center px-2.5 py-1.5 mt-2 text-xs font-medium  bg-blue-50 border border-blue-100 rounded hover:bg-blue-100 transition duration-200">
                                            <img src="/assets/pdf.png" alt="PDF Icon" class="h-10 w-10 mr-1.5">
                                            @php
                                                $filename = basename($attachment);
                                                $displayName = preg_replace('/^\d+_/', '', $filename);
                                            @endphp
                                            {{ $displayName }}
                                        </a>
                                    @elseif ($extension === 'docx' || $extension === 'doc')
                                        <a href="{{ asset('storage/' . $attachment) }}" target="_blank"
                                            class="inline-flex items-center px-2.5 py-1.5 mt-2 text-xs font-medium  bg-blue-50 border border-blue-100 rounded hover:bg-blue-100 transition duration-200">
                                            <img src="/assets/doc.png" alt="Word Icon" class="h-10 w-10 mr-1.5">
                                            @php
                                                $filename = basename($attachment);
                                                $displayName = preg_replace('/^\d+_/', '', $filename);
                                            @endphp
                                            {{ $displayName }}
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $attachment) }}" target="_blank"
                                            class="inline-flex items-center px-2.5 py-1.5 mt-2 text-xs font-medium  bg-blue-50 border border-blue-100 rounded hover:bg-blue-100 transition duration-200">
                                            <img src="/assets/other.png" alt="Word Icon" class="h-10 w-10 mr-1.5">
                                            @php
                                                $filename = basename($attachment);
                                                $displayName = preg_replace('/^\d+_/', '', $filename);
                                            @endphp
                                            {{ $displayName }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex {{ $msg['side'] === 'left' ? '' : 'justify-end' }}">
                <div class="flex items-center mb-6">
                    @if ($msg['side'] === 'left')
                        <div
                            class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-semibold mr-2">
                            {{ substr($msg['user'], 0, 1) }}
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span
                            class="font-medium text-sm {{ $msg['side'] === 'left' ? 'text-blue-800' : 'text-green-800' }}">
                            {{ $msg['user'] }}
                        </span>
                        <span
                            class="text-xs text-gray-500 {{ $msg['side'] === 'left' ? 'text-left' : 'text-right' }}">
                            {{ \Carbon\Carbon::parse($msg['created_at'])->diffInHours(now()) > 24 ? $msg['adate'] : $msg['created_at'] }}
                        </span>
                    </div>
                    @if ($msg['side'] === 'right')
                        <div
                            class="w-8 h-8 rounded-full bg-[#BCEC88] text-black flex items-center justify-center text-sm font-semibold ml-2">
                            {{ substr($msg['user'], 0, 1) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endforeach
