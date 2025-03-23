<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body
    class="min-h-screen antialiased bg-surface-alt dark:bg-linear-to-b dark:from-surface-dark dark:to-surface-dark-alt">
    <!-- Main Container -->
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 bg-muted">
        <!-- Card Wrapper -->
        <div class="flex w-full max-w-md flex-col gap-6">
            <!-- Logo Link -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium">
                <x-app-logo-icon class="size-9 fill-current text-on-surface-strong dark:text-on-surface-dark-strong" />
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Content Card -->
            <div class="flex flex-col gap-6">
                <div
                    class="rounded-radius border border-outline bg-surface shadow-xs dark:bg-surface-dark dark:border-outline-dark">
                    <div class="px-10 py-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.scripts')
</body>

</html>
