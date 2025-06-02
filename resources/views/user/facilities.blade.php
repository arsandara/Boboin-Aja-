@extends('layouts.layout')

@section('content')
  <!-- Hero Section -->
<section class="relative">
    <img class="w-full h-96 object-cover" src="{{ asset('images/HEADER.png') }}" alt="Header Image" height="600" width="1920">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white px-4">
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold">
        <span class="block sm:inline">More Than a Stay,</span>
        <span class="block sm:inline">It's Where You Find Peace</span>
    </h1>
    <p class="mt-3 text-sm sm:text-base sm:mt-4">
        <span class="block sm:inline">Find your perfect stay, where modern comfort</span>
        <span class="block sm:inline">meets serene tranquility.</span>
        <span class="block sm:inline">Recharge, unwind, and experience peace</span>
        <span class="block sm:inline">like never before.</span>
    </p>
    
    <!-- Booking Form -->
<div class="mt-4 sm:mt-6 bg-white text-black rounded-lg shadow-lg p-3 sm:p-4 w-full max-w-3xl mx-auto">
    <div class="grid grid-cols-2 xs:flex flex-wrap items-end justify-between gap-3 sm:gap-4">
        <!-- Check In -->
        <div class="col-span-1 xs:w-auto flex-1 min-w-[120px]">
            <label class="block text-xs sm:text-sm font-medium mb-1" for="checkin">
                Check In
            </label>
            <input class="w-full text-xs sm:text-sm p-2 border border-gray-300 rounded-md" 
                   id="checkin" type="date" required>
        </div>

        <!-- Check Out -->
        <div class="col-span-1 xs:w-auto flex-1 min-w-[120px]">
            <label class="block text-xs sm:text-sm font-medium mb-1" for="checkout">
                Check Out
            </label>
            <input class="w-full text-xs sm:text-sm p-2 border border-gray-300 rounded-md" 
                   id="checkout" type="date" required>
        </div>
        
        <!-- Person -->
        <div class="col-span-2 xs:col-span-1 xs:w-auto flex-1 min-w-[120px]">
            <label class="block text-xs sm:text-sm font-medium mb-1" for="person">
                Person
            </label>
            <select class="w-full text-xs sm:text-sm p-2 border border-gray-300 rounded-md" 
                    id="person" required>
                <option value="01 Person">01 Person</option>
                <option value="02 Person" selected>02 Person</option>
                <option value="03 Person">03 Person</option>
                <option value="04 Person">04 Person</option>
            </select>
        </div>
        
        <!-- Available Room Button -->
        <div class="col-span-2 xs:col-span-1 xs:w-auto mt-1">
            <a href="{{ url('/rooms') }}" 
               class="block w-full xs:w-auto text-center bg-teal-900 hover:bg-teal-800 text-white text-xs sm:text-sm px-4 py-2 rounded-md transition-colors">
                Available Room
            </a>
        </div>
    </div>
</div>

<!-- Spacer to prevent collision with next section -->
<div class="h-6 sm:h-8"></div>

  <!-- Services & Facilities -->
<section class="container mx-auto py-12 px-6">
    <h2 class="text-2xl font-bold mb-6">
        Services & Facilities
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="relative-container row-span-2">
        <img alt="Cozy Rooms" class="w-full h-full object-cover" src="{{ asset('images/Cozy Rooms.png') }}">
        <div class="overlay">Cozy Rooms</div>
        </div>
        <div class="relative-container">
        <img alt="Private Jacuzzi" class="w-full h-full object-cover" src="{{ asset('images/Private Jacuzzi.png') }}">
        <div class="overlay">Private Jacuzzi</div>
        </div>
        <div class="relative-container">
        <img alt="Dog Park" class="w-full h-full object-cover" src="{{ asset('images/Dog Park.png') }}">
        <div class="overlay">Dog Park</div>
        </div>
        <div class="relative-container">
        <img alt="Outdoor Lounge" class="w-full h-full object-cover" src="{{ asset('images/Outdoor Lounge.png') }}">
        <div class="overlay">Outdoor Lounge</div>
        </div>
        <div class="relative-container">
        <img alt="Dining & Bar" class="w-full h-full object-cover" src="{{ asset('images/Dining and Bar.png') }}">
        <div class="overlay">Dining & Bar</div>
        </div>
    </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/dateSync.js') }}"></script>
@endsection
