@extends('layouts.layout')

@section('content')
<div class="ml-64 flex-1">
    <div class="bg-teal-800 text-white p-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Edit Reservation</h1>
            <div>{{ date('d F Y') }}</div>
        </div>
    </div>

    <div class="p-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('reservation.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Guest Name</label>
                        <input type="text" value="{{ $reservation->guest_name }}" 
                               class="w-full border rounded p-2" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Room Type</label>
                        <input type="text" value="{{ $reservation->room_name }}" 
                               class="w-full border rounded p-2" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Check-in Date</label>
                        <input type="date" name="check_in" value="{{ $reservation->check_in }}" 
                               class="w-full border rounded p-2 @error('check_in') border-red-500 @enderror">
                        @error('check_in')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Check-out Date</label>
                        <input type="date" name="check_out" value="{{ $reservation->check_out }}" 
                               class="w-full border rounded p-2 @error('check_out') border-red-500 @enderror">
                        @error('check_out')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Additional Requests</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="early_checkin" value="1" 
                                   {{ $reservation->early_checkin ? 'checked' : '' }} 
                                   class="rounded text-teal-600">
                            <span>Early Check-in (+Rp 50.000)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="late_checkout" value="1" 
                                   {{ $reservation->late_checkout ? 'checked' : '' }} 
                                   class="rounded text-teal-600">
                            <span>Late Check-out (+Rp 50.000)</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="extra_bed" value="1" 
                                   {{ $reservation->extra_bed ? 'checked' : '' }} 
                                   class="rounded text-teal-600">
                            <span>Extra Bed (+Rp 150.000)</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="{{ route('dashboard') }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700">
                        Update Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection