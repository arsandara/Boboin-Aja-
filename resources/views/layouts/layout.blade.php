<meta name="csrf-token" content="{{ csrf_token() }}">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Boboin.Aja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-poppins">

    <!-- Header/Navbar -->
    <header class="bg-teal-900 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="{{ asset('images/Logo.png') }}" alt="Boboin.Aja logo" class="h-10 mr-3">
            </div>
            <nav class="items-center">
                <a class="hover:text-gray-300" href="{{ url('/') }}">Home</a>
                <a class="hover:text-gray-300" href="{{ url('/rooms') }}">Rooms</a>
                <a class="hover:text-gray-300" href="{{ url('/facilities') }}">Facilities</a>
                <a class="hover:text-gray-300" href="{{ url('/contact') }}">Contact</a>
            </nav>
            <div class="flex items-center">
                @auth
                <div class="relative">
                    <button id="profileMenuButton" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('default-profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full border border-white shadow">
                    </button>
                    <div id="profileMenu" class="hidden fixed right-2 mt-2 w-40 bg-white border rounded shadow-lg z-50">
                        <ul class="py-2 text-sm text-gray-800">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center justify-between w-full px-4 py-2 hover:bg-gray-100">
                                        Logout
                                        <i class="fas fa-sign-out-alt text-red-500 ml-2"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <button id="openPopup" class="bg-white text-teal-900 px-4 py-2 rounded hover:bg-gray-200">
                    Login / Sign Up
                </button>
                @endauth
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

    <!-- Content -->
    <main>
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
    </script>
    @yield('scripts')
</body>
</html>
