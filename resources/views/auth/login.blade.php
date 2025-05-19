@extends('layouts.layout')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <img src="{{ asset('Logogreen.png') }}" alt="Boboin.Aja logo" class="w-40 h-auto mx-auto mb-4">
            <h2 class="text-2xl font-bold text-teal-900">Login to Your Account</h2>
            <p class="text-gray-600 text-sm">Find your perfect stay, where modern comfort meets serene tranquility.</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" 
                    class="w-full p-2 border rounded @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" 
                    class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-teal-900 text-white py-2 rounded hover:bg-teal-800">
                Log In
            </button>
        </form>
        
        <p class="text-center mt-4 text-sm">
            Don't have an account? <a href="{{ route('register') }}" class="text-green-500 hover:underline">Sign Up</a>
        </p>
    </div>
</div>
@endsection