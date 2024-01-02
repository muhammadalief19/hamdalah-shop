        <!-- Sidebar (hidden on mobile) -->
        <aside 
            x-show="open" 
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            class="w-64 bg-base-100 text-slate-700 py-4 shadow-lg flex flex-col"
            x-transition:leave-end="-translate-x-full"
        >
            <h2 class="text-2xl font-semibold mb-4 px-4">
                Hamdalah Shop
            </h2>
            <ul class="text-base flex flex-col gap-2 h-max py-2">
                <li class="{{$title == "Dashboard" ? "bg-base-200" : "hover:bg-base-200"}} px-4 py-2">
                    <a href="/" class="block py-2">Dashboard</a>
                </li>
                <li class="{{$title == "Products" ? "bg-base-200" : "hover:bg-base-200"}} px-4 py-2">
                    <a href="/products" class="block py-2">Products</a>
                </li>
                <li class="{{$title == "Payment" ? "bg-base-200" : "hover:bg-base-200"}} px-4 py-2">
                    <a href="#" class="block py-2">Payment</a>
                </li>
                <li class="{{$title == "Profile" ? "bg-base-200" : "hover:bg-base-200"}} px-4 py-2">
                    <a href="/profile" class="block py-2">Profile</a>
                </li>
                <li class="{{$title == "search" ? "bg-base-200" : "hover:bg-base-200"}} px-4 py-2">
                    <a href="{{ route('product.show') }}" class="block py-2">Search</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" class="w-full flex-1 flex items-end px-2">
                @csrf
                <button class="flex gap-3 h-max items-center" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                    </svg>
                    <span>
                        logout
                    </span>
                </button>
            </form>
        </aside>