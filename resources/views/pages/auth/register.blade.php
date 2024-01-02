<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Register Template</title>
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

        <!-- Register Section -->
        <div class="w-full md:w-1/2 flex flex-col">

            <div class="flex justify-center md:justify-start pt-12 md:pl-12 md:-mb-12">
                <span class="bg-black text-white font-bold text-xl p-4" alt="Logo">
                    Hamdalah
                </span>
            </div>

            <div class="flex flex-col justify-center md:justify-start my-auto pt-8 md:pt-0 px-8 md:px-24 lg:px-32">
                <p class="text-center text-3xl">Join Us.</p>
                <form class="flex flex-col pt-3 md:pt-8 gap-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" id="name" name="name" placeholder="John Smith" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" />
                        @error('name')                   
                        <p class="text-sm text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="username" class="text-lg">Username</label>
                        <input type="text" id="username" name="username" placeholder="John Smith" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('username') border-red-500 @enderror" />
                        @error('username')                   
                        <p class="text-sm text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="text-lg">Email</label>
                        <input type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" />
                        @error('email')                   
                        <p class="text-sm text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
    
                    <div class="flex flex-col">
                        <label for="password" class="text-lg">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" />
                        @error('password')                   
                        <p class="text-sm text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="foto_profile" class="text-lg">Foto</label>
                        <input type="file" id="foto_profile"  name="foto_profile" placeholder="Password" class="file-input" />
                        @error('foto_profile')                   
                        <p class="text-sm text-red-500 italic">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
    
                    <button class="btn btn-neutral" type="submit">
                        Register
                    </button>
                </form>
                <div class="text-center pt-12 pb-12">
                    <p>Already have an account? <a href="/login" class="underline font-semibold">Log in here.</a></p>
                </div>
            </div>

        </div>

        <!-- Image Section -->
        <div class="w-1/2 shadow-2xl">
            <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/IXUM4cJynP0" alt="Background" />
        </div>
    </div>

</body>
</html>