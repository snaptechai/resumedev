<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-surface dark:bg-surface-dark-alt">

    <x-navbar />

    {{ $slot }}

    @include('partials.scripts')
</body>

</html>
