<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin - Boboin.Aja')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div class="bg-teal-900 text-white w-64 flex flex-col p-5 fixed h-full">
      <div class="flex items-center justify-center mb-6">
        <img src="{{ asset('Logo.png') }}" alt="Boboin.Aja Logo" class="h-12" />
      </div>
      <nav class="space-y-3">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-teal-700' : 'hover:bg-teal-700' }}">
          <i class="fas fa-tachometer-alt w-6 text-center mr-3"></i><span>Dashboard</span>
        </a>
        <a href="{{ route('admin.reservations.index') }}" class="flex items-center py-3 px-4 rounded-lg {{ request()->is('admin/reservations*') ? 'bg-teal-700' : 'hover:bg-teal-700' }}">
          <i class="fas fa-calendar-alt w-6 text-center mr-3"></i><span>Reservations</span>
        </a>
        <a href="{{ route('admin.rooms.index') }}" class="flex items-center py-3 px-4 rounded-lg {{ request()->is('admin/rooms*') ? 'bg-teal-700' : 'hover:bg-teal-700' }}">
          <i class="fas fa-bed w-6 text-center mr-3"></i><span>Rooms</span>
        </a>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="ml-64 flex-1">
      <div class="bg-teal-800 text-white p-6">
        <div class="flex justify-between items-center">
          <h1 class="text-2xl font-semibold">@yield('title')</h1>
          <div>Today: {{ now()->format('d F Y') }}</div>
        </div>
        <div class="flex items-center">
                @auth
                <div class="relative">
                    <button id="profileMenuButton" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('storage/default-profile.png') }}" alt="Profile" class="w-9 h-9 rounded-full border border-white shadow">
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

      <div class="p-6">
        @yield('content')
      </div>
    </div>
  </div>
</body>
</html>
