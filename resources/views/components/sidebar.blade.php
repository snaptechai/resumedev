<!-- Skip to main content link -->
<a class="sr-only" href="#main-content">{{ __('Skip to main content') }}</a>

<!-- Dark overlay -->
<div x-cloak x-show="showSidebar" x-on:click="showSidebar = false" x-transition.opacity
    class="fixed inset-0 z-10 bg-surface-dark/10 backdrop-blur-xs lg:hidden" aria-hidden="true"></div>

<!-- Sidebar Navigation -->
<nav x-cloak x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'"
    class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col border-r border-outline bg-green-100 p-4 transition-transform duration-300 lg:w-64 lg:translate-x-0 lg:relative dark:border-outline-dark dark:bg-surface-dark"
    aria-label="sidebar navigation">
    <!-- Mobile close button -->
    <button x-cloak x-on:click="showSidebar = false"
        class="block lg:hidden whitespace-nowrap w-fit mb-4 rounded-radius p-2 text-sm font-medium tracking-wide text-on-surface text-center hover:bg-primary/10 hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-surface-alt active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:hover:bg-primary-dark/10 dark:text-on-surface-dark-strong dark:focus-visible:outline-surface-dark-alt">
        <x-icons.x-mark variant="outline" size="md" />
    </button>

    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="mb-4 flex items-center space-x-2 lg:ml-0">
        <x-app-logo class="size-8" />
    </a>

    <!-- Platform Label -->
    {{-- <div class="px-1 py-2">
        <div class="text-xs leading-none text-on-surface dark:text-on-surface-dark">{{ __('Platform') }}</div>
    </div> --}}

    <!-- Navigation Links -->
    <div class="flex flex-col gap-2 overflow-y-auto pb-6 h-full">
        <!-- Main Navigation -->
        <ul class="flex flex-col gap-2">
            <li>
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-icons.home variant="outline" />
                    <span>{{ __('Dashboard') }}</span>
                </x-sidebar-link>
            </li>
            {{-- 
            <li>
                <x-sidebar-link href="" >
                    <x-icon name="document-chart-bar" outline/>
                    <span>{{ __('Affiliate Dashboard') }}</span>
                </x-sidebar-link>
            </li><li>
                <x-sidebar-link href="">
                    <x-icon name="map-pin" outline />
                    <span>{{ __('Leads') }}</span>
                </x-sidebar-link>
            </li> --}}
            {{-- <li>
                <x-sidebar-link href="">
                    <x-icon name="user-group" outline />
                    <span>{{ __('Affiliate Users') }}</span>
                </x-sidebar-link>
            </li> --}}
            {{-- <li x-data="{ open: {{ request()->routeIs('packages.*') ? 'true' : 'false' }} }">
                <x-sidebar-link @click.prevent="open = !open">
                    <x-icon name="archive-box-arrow-down" outline />
                    <span>{{ __('Orders') }}</span>
                    <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </x-sidebar-link>
                <ul x-show="open" class="pl-6 space-y-2">
                    <li>
                        <x-sidebar-link href="{{ route('packages.index') }}" :active="request()->routeIs('packages.index')">
                            <x-icon name="rectangle-group" outline />
                            <span>{{ __('Packages') }}</span>
                        </x-sidebar-link>
                    </li>
                </ul>
            </li> --}}
            <li>
                <x-sidebar-link href="{{ route('orders.index') }}" :active="request()->routeIs('orders.*')">
                    <x-icon name="archive-box-arrow-down" outline />
                    <span>{{ __('Orders') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('reviews.index') }}" :active="request()->routeIs('reviews.*')">
                    <x-icon name="ticket" outline />
                    <span>{{ __('Review') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('articles.index') }}" :active="request()->routeIs('articles.*')">
                    <x-icon name="newspaper" outline />
                    <span>{{ __('Articles') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('article-categories.index') }}" :active="request()->routeIs('article-categories.*')">
                    <x-icon name="square-3-stack-3d" outline />
                    <span>{{ __('Article Category') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('tags.index') }}" :active="request()->routeIs('tags.*')">
                    <x-icon name="tag" outline />
                    <span>{{ __('Article Tag') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('redirect-links.index') }}" :active="request()->routeIs('redirect-links.*')">
                    <x-icon name="link" outline />
                    <span>{{ __('Redirect Link') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                    <x-icon name="users" outline />
                    <span>{{ __('Users') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('packages.index') }}" :active="request()->routeIs('packages.index')">
                    <x-icon name="rectangle-group" outline />
                    <span>{{ __('Packages') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('templates.index') }}" :active="request()->routeIs('templates.index')">
                    <x-icon name="clipboard-document-list" outline />
                    <span>{{ __('Template') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('coupon.index') }}" :active="request()->routeIs('coupon.index')">
                    <x-icon name="tag" outline />
                    <span>{{ __('Coupon') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('banner.index') }}" :active="request()->routeIs('banner.index')">
                    <x-icon name="flag" outline />
                    <span>{{ __('Banner') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('faqs.index') }}" :active="request()->routeIs('faqs.*')">
                    <x-icon name="chat-bubble-left-ellipsis" outline />
                    <span>{{ __('FAQ') }}</span>
                </x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link href="{{ route('page-details.index') }}" :active="request()->routeIs('page-details.*')">
                    <x-icon name="document-text" outline />
                    <span>{{ __('Page Content') }}</span>
                </x-sidebar-link>
            </li>
        </ul>
    </div>
 
    <x-dropdown align="bottom-14 left-0 lg:left-full lg:ml-2 lg:bottom-0">
        <x-slot:trigger>
            <button type="button" x-bind:class="dropDownIsOpen ? 'bg-primary/10 dark:bg-primary-dark/10' : ''"
                class="flex w-full items-center gap-2 rounded-radius p-2 text-left text-on-surface hover:bg-primary/5 hover:text-on-surface-strong focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary dark:text-on-surface-dark dark:hover:bg-primary-dark/5 dark:hover:text-on-surface-dark-strong dark:focus-visible:outline-primary-dark">
 
                <div class="relative"> 
                    <x-icon name="bell-alert" outline />
                    @php $unreadCount = Auth::user()->getMessageNotifications()->count(); @endphp
                    @if ($unreadCount > 0)
                        <span
                            class="absolute -top-1 -right-1 inline-flex items-center justify-center rounded-full bg-red-600 px-1.5 py-0.5 text-[10px] font-semibold text-white dark:bg-red-500">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </div>
 
                <div class="flex items-center gap-3">
                    <span
                        class="flex size-8 text-sm font-medium items-center justify-center overflow-hidden rounded-radius border border-outline bg-surface-alt tracking-wider text-on-surface/80 dark:border-outline-dark dark:bg-surface-dark-alt dark:text-on-surface-dark/80">
                        {{ auth()->user()->full_name[0] }}
                    </span>
                    <span
                        class="text-sm text-on-surface-strong dark:text-on-surface-dark-strong">{{ auth()->user()->full_name }}</span>
                </div>

                <x-icons.chevron-right strokeWidth="2" size="sm" class="ml-auto shrink-0 -rotate-90 lg:rotate-0" />
            </button>
        </x-slot:trigger>

        <x-slot:content>
            <ul>
                <li class="border-b border-outline dark:border-outline-dark">
                    <div class="flex flex-col px-4 py-2">
                        <span
                            class="text-sm font-medium text-on-surface-strong dark:text-on-surface-dark-strong">{{ auth()->user()->full_name }}</span>
                        <p class="text-xs text-on-surface dark:text-on-surface-dark">{{ auth()->user()->username }}</p>
                    </div>
                </li>
                <li>
                    <x-dropdown-link href="{{ route('notification.index') }}">
                        <x-icon name="bell-alert" outline />
                        {{ __('Notifications') }}
                            @php $unreadCount = Auth::user()->getMessageNotifications()->count(); @endphp
                            @if ($unreadCount > 0)
                                <span class="ml-auto inline-flex items-center justify-center rounded-full bg-red-600 px-2 py-0.5 text-xs font-bold text-white dark:bg-red-500">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                    </x-dropdown-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <x-icons.arrow-right-start-on-rectangle variant="mini" />
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>
        </x-slot:content>
    </x-dropdown>
    <div class="mt-auto pt-4 text-xs text-center text-on-surface/70 dark:text-on-surface-dark/70">
        © {{ date('Y') }} All Rights Reserved by <br> <b><a href="https://snaptechai.com/" target="Blank">Snaptech ai</a> </b>
    </div>
</nav>
