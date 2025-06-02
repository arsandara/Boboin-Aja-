<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Boboin.Aja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-poppins">

    <header class="bg-teal-900 text-white fixed top-0 left-0 w-full z-50 shadow-md">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/Logo.png') }}" alt="Boboin.Aja logo" class="h-10">
            </div>

            <!-- Desktop Nav (Tengah) -->
            <nav class="hidden md:block absolute left-1/2 transform -translate-x-1/2">
                <div class="flex space-x-8">
                    <a href="{{ url('/') }}" class="hover:text-gray-300">Home</a>
                    <a href="{{ url('/rooms') }}" class="hover:text-gray-300">Rooms</a>
                    <a href="{{ url('/facilities') }}" class="hover:text-gray-300">Facilities</a>
                    <a href="{{ url('/contact') }}" class="hover:text-gray-300">Contact</a>
                </div>
            </nav>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Login/Sign Up Button (Selalu Tampil) -->
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="mr-2 md:mr-0">
                        @csrf
                        <button type="submit" class="hover:text-gray-300">Logout</button>
                    </form>
                @else
                    <button id="openPopup" class="bg-white text-teal-900 px-4 py-2 rounded hover:bg-gray-200 mr-2 md:mr-0">
                        Login / Sign Up
                    </button>
                @endauth

                <!-- Hamburger Icon (Mobile Only) -->
                <button id="menu-toggle" class="md:hidden text-2xl focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Popup (Tanpa Login/Sign Up) -->
        <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden justify-center items-start pt-24">
            <div class="bg-white text-teal-900 w-11/12 max-w-xs rounded-lg p-6 shadow-lg relative">
                <button id="close-mobile-menu" class="absolute top-4 right-4 text-2xl text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <div class="flex flex-col space-y-4 text-center text-lg font-medium mt-6">
                    <a href="{{ url('/') }}" class="hover:text-teal-700">Home</a>
                    <a href="{{ url('/rooms') }}" class="hover:text-teal-700">Rooms</a>
                    <a href="{{ url('/facilities') }}" class="hover:text-teal-700">Facilities</a>
                    <a href="{{ url('/contact') }}" class="hover:text-teal-700">Contact</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Popup Login/Register -->
    <div id="popupContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="popup-content bg-white p-8 rounded shadow-lg relative w-full max-w-md">
            <button id="closePopup" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl">&times;</button>
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/Logogreen.png') }}" alt="Boboin.Aja logo" class="w-40 h-auto mb-4">
                <p class="text-center text-gray-600 text-sm">Find your perfect stay, where modern comfort meets serene tranquility.</p>
            </div>
            <div class="flex justify-center mb-4 border-b">
                <button class="tab-button active px-4 py-2 border-b-2 border-teal-900 text-teal-900" onclick="showTab('signin')">Log In</button>
                <button class="tab-button px-4 py-2" onclick="showTab('signup')">Sign Up</button>
            </div>
            @include('auth.login')
            @include('auth.register')
        </div>
    </div>

    <!-- Content dengan padding-top untuk mengkompensasi fixed header -->
    <main class="pt-20">
        <!-- pt-20 memberikan space 80px (5rem) untuk header yang fixed -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-teal-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 max-w-7xl mx-auto">
                <div class="flex justify-center">
                    <div class="w-48">
                        <img src="{{ asset('images/Logo.png') }}" alt="Boboin.Aja logo" class="w-full h-auto" />
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">About Boboin.Aja</h3>
                    <p class="text-gray-300 text-justify">
                        Our hotel is designed for those who seek comfort, relaxation, and a deep connection with nature. With cozy
                        and well-appointed rooms, modern facilities, and breathtaking views of lush greenery, we provide a serene
                        escape from the noise and stress of daily life.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 opacity-0">Invisible Heading</h3>
                    <p class="text-gray-300 text-justify">
                        As part of our commitment to sustainability and guest well-being, we proudly maintain a 100% smoke-free
                        environment. We believe in preserving the purity of the air, allowing guests to fully enjoy the fresh,
                        unpolluted atmosphere that nature provides.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4 opacity-0">Invisible Heading</h3>
                    <p class="text-gray-300 text-justify">
                        Surrounded by nature and designed for relaxation, our hotel is the perfect place to unwind, recharge, and
                        embrace the beauty of the outdoors.
                    </p>
                </div>
            </div>
            <div class="text-center mt-10 pt-4 border-t border-teal-800">
                <p class="text-gray-400">© Copyright Boboin.Aja, All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Profile dropdown toggle
        document.getElementById("profileMenuButton")?.addEventListener("click", function () {
            const menu = document.getElementById("profileMenu");
            menu.classList.toggle("hidden");
        });

        window.addEventListener("click", function (event) {
            const menu = document.getElementById("profileMenu");
            const button = document.getElementById("profileMenuButton");
            if (menu && button && !button.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add("hidden");
            }
        });

        document.getElementById("menu-toggle").addEventListener("click", function () {
            const menu = document.getElementById("nav-menu");
            menu.classList.toggle("hidden");
        });

        // Popup auth modal
        function openPopup(tab = "signin") {
            const popupContainer = document.getElementById("popupContainer");
            popupContainer.classList.remove("hidden");
            popupContainer.classList.add("flex");
            showTab(tab);
        }

        function closePopup() {
            const popupContainer = document.getElementById("popupContainer");
            popupContainer.classList.remove("flex");
            popupContainer.classList.add("hidden");
        }

        document.getElementById("openPopup")?.addEventListener("click", () => openPopup("signin"));
        document.getElementById("closePopup")?.addEventListener("click", closePopup);

        window.addEventListener("click", function (event) {
            const popupContainer = document.getElementById("popupContainer");
            if (event.target === popupContainer) {
                closePopup();
            }
        });

        function showTab(tabId) {
            document.querySelectorAll(".tab-button").forEach(btn => {
                btn.classList.remove("active", "border-b-2", "border-teal-900", "text-teal-900");
            });
            document.querySelectorAll(".tab-content").forEach(tab => {
                tab.classList.add("hidden");
                tab.classList.remove("active");
            });
            const activeButton = document.querySelector(`[onclick="showTab('${tabId}')"]`);
            const activeContent = document.getElementById(tabId);
            activeButton?.classList.add("active", "border-b-2", "border-teal-900", "text-teal-900");
            activeContent?.classList.remove("hidden");
            activeContent?.classList.add("active");
        }

        // Script untuk toggle mobile menu
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenu = document.getElementById('close-mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');
            mobileMenu.classList.add('flex');
        });

        closeMenu.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex');
        });
    </script>
    @yield('scripts')
</body>
</html>