<!-- resources/views/auth/register-popup.blade.php -->
<div id="signup" class="tab-content hidden">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="w-full p-2 border rounded mb-1">
        @if($errors->has('name'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('name') }}</p>
        @endif

        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full p-2 border rounded mb-1">
        @if($errors->has('email'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('email') }}</p>
        @endif

        <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded mb-1">
        @if($errors->has('password'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('password') }}</p>
        @endif

        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full p-2 border rounded mb-3">

        <button type="submit" class="w-full bg-teal-900 text-white py-2 rounded hover:bg-teal-800">Sign Up</button>
    </form>
    <p class="text-center mt-4 text-sm">
        Already have an account? <a href="#" onclick="showTab('signin')" class="text-green-500 hover:underline">Log In</a>
    </p>
</div>
