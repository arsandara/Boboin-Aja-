<!-- resources/views/auth/register-popup.blade.php -->
<div id="signup" class="tab-content hidden">
    <form action="{{ route('register') }}" method="POST">
        @csrf
        @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
        <input type="text" required name="name" placeholder="Full Name" class="w-full p-2 border rounded mb-1">
        @if($errors->has('name'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('name') }}</p>
        @endif

        <input type="email" required name="email" placeholder="Email" class="w-full p-2 border rounded mb-1">
        @if($errors->has('email'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('email') }}</p>
        @endif

        <input type="password" required name="password" placeholder="Password" class="w-full p-2 border rounded mb-1">
        @if($errors->has('password'))
            <p class="text-red-500 text-xs mb-2">{{ $errors->first('password') }}</p>
        @endif
        
        <button type="submit" class="w-full bg-teal-900 text-white py-2 rounded hover:bg-teal-800">Sign Up</button>
    </form>
    <p class="text-center mt-4 text-sm">
        Already have an account? <a href="#" onclick="showTab('signin')" class="text-green-500 hover:underline">Log In</a>
    </p>
</div>
