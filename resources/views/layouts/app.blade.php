<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SERVICE LOGISTIQUE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- font awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- jquery --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
</head>

<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <x-nav-bar></x-nav-bar>
    <x-side-bar></x-side-bar>
    <main class="p-4  min-h-screen pt-2 w-full">
        @yield('content')
    </main>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
