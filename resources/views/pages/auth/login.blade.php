<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>
</head>
<body class="bg-white font-family-karla h-screen">

    <div class="w-full flex flex-wrap">

        <!-- Login Section -->
        <div class="w-full md:w-1/2 flex flex-col">
            @if (session()->has('success'))      
            <div class="py-5 px-10">
            <div class="alert alert-success" id="alertSuccess">
              <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
              <span>
                {{session('success')}}
              </span>
              <button class="btn btn-sm btn-primary" onclick="hideAlertSuccess()">Accept</button>
            </div>
            </div>
            @endif

            @error('error')                   
            <p class="text-sm text-center py-7 text-red-500 italic">
                {{ $message }}
            </p>
            @enderror

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-24">
                <span href="" class="bg-black text-white font-bold text-xl p-4">
                    Hamdalah
                </span>
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Welcome.</p>
                <form class="flex flex-col pt-3 md:pt-8 gap-5" method="POST" action="/login">
                    @csrf
                    <div class="flex flex-col">
                        <label for="email" class="text-lg">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                        @error('email')                   
                        <p class="text-sm py-1 text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
    
                    <div class="flex flex-col">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
    
                    <button class="btn btn-neutral" type="submit">Login</button>
                </form>
                <div class="text-center pt-12 pb-12">
                    <p>Don't have an account? <a href="/register" class="underline font-semibold">Register here.</a></p>
                </div>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/IXUM4cJynP0">
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>