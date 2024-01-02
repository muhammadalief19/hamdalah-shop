<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{$title}} </title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <div x-data="{ open: true }" class="flex h-screen bg-base-300 text-slate-700 box-border overflow-hidden">
        @include('partials.sidebar')

        <!-- Main content -->
        <main 
            class="flex-1 p-8 transition-all overflow-y-auto"
        >
            @yield('body')
        </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>