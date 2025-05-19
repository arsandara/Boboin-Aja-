@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <img src="{{ asset('Logogreen.png') }}" alt="Boboin.Aja logo" class="w-40 h-auto mx-auto mb-4">
            <h2 class="text-2xl font-bold text-teal-900">Create an Account</h2>
            <p class="text-gray-600 text-sm">Join us to book your perfect stay</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-2">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                    class="w-full p-2 border rounded">
            </div>
            
            <button type="submit" class="w-full bg-teal-900 text-white py-2 rounded hover:bg-teal-800">
                Register
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm">
            Already have an account? <a href="{{ route('login') }}" class="text-green-500 hover:underline">Log In</a>
        </p>
    </div>
</div>
@endsection