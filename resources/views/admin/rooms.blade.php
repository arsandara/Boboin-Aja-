@extends('layouts.layout')
@section('content')
<div class="bg-white rounded-lg shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Rooms</h1>
        <div>Today, {{ now()->format('F j, Y') }}</div>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('admin.rooms') }}" method="GET">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500" placeholder="Search guest name...">
            </div>
        </form>
    </div>

    <!-- Booking Cards -->
    <div class="space-y-6">
        @forelse($reservations as $reservation)
        <div class="bg-white rounded-lg shadow-md p-6 booking-card">
            <!-- Sisa kode sama seperti sebelumnya, hanya ubah route checkout -->
            <div class="mt-6 flex justify-end">
                <form action="{{ route('admin.checkout') }}" method="POST" onsubmit="return confirm('Are you sure you want to check out this guest?');">
                    @csrf
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium">
                        Check Out
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-4 text-gray-500">
            No checked-in guests found.
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="search"]');
        const cards = document.querySelectorAll('.booking-card');

        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            
            cards.forEach(card => {
                const guestName = card.querySelector('.guest-name').textContent.toLowerCase();
                card.style.display = guestName.includes(searchTerm) ? '' : 'none';
            });
        });
    });
</script>
@endpush