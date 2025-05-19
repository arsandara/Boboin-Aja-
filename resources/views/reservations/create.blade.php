@extends('layouts.layout')

@section('content')
<div class="header">
    <img src="{{ asset('LOGO.png') }}" alt="boboin.aja" class="logo">
    <div class="page-title">Review Booking</div>
</div>
<div class="container mx-auto p-4 max-w-4xl space-y-6">
    <!-- Booking Details -->
    <div class="bg-white p-4 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-green-800 font-semibold">Check In</p>
                <p id="display-checkin" class="font-medium">October 10, 2025 (14.00 WIB)</p>
            </div>
            <div>
                <p class="text-sm text-green-800 font-semibold">Check Out</p>
                <p id="display-checkout" class="font-medium">October 15, 2025 (12.00 WIB)</p>
            </div>
            <div>
                <p class="text-sm text-green-800 font-semibold">Person</p>
                <p id="display-person" class="font-medium">02 Person</p>
            </div>
        </div>
    </div>
    
    <!-- Room -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex flex-col md:flex-row gap-4 p-4">
            <div class="w-full md:w-1/3">
                <img src="{{ asset($room->image_booking) }}" 
                     alt="{{ $room->room_name }}" class="w-full rounded-lg">
            </div>
            <div class="w-full md:w-2/3">
                <h1 class="text-xl font-bold">{{ $room->room_name }}</h1>
                <p class="text-gray-700 mt-2">⭐ {{ $room->rating ?? '0' }}</p>
                <p class="text-gray-700">👥 {{ $room->capacity ?? '0' }} peoples</p>
                @if($room->breakfast_included)
                    <p class="text-gray-700">🍳 Breakfast included</p>
                @endif
                <p class="text-2xl font-bold text-teal-900 mt-2">{{ 'Rp. ' . number_format($room->price, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Form container - single white card -->
    <div class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <h2 class="text-xl font-bold mb-4">Personal Information</h2>
        <form method="POST" action="{{ route('reservations.store') }}" class="space-y-4" id="bookingForm" novalidate>
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->room_id }}">
            <input type="hidden" name="checkin" id="form-checkin">
            <input type="hidden" name="checkout" id="form-checkout">
            <input type="hidden" name="person" id="form-person">
            <!-- First Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    First Name<span class="text-red-500 ml-0.5">*</span>
                </label>
                <input type="text" name="first_name" class="input-field @error('first_name') border-red-500 @enderror" id="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @else
                    <p class="text-red-500 text-sm hidden" id="first_name_error">Please fill in your first name</p>
                @enderror
            </div>
            
            <!-- Last Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                <input type="text" name="last_name" class="input-field" value="{{ old('last_name') }}">
            </div>
                    
            <!-- Date of Birth -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Date of Birth<span class="text-red-500 ml-0.5">*</span>
                </label>
                <div class="date-input">
                    <input type="text" name="day" class="input-field @error('day') border-red-500 @enderror" placeholder="dd" maxlength="2" 
                        id="day" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{ old('day') }}">
                    <input type="text" name="month" class="input-field @error('month') border-red-500 @enderror" placeholder="mm" maxlength="2"
                        id="month" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{ old('month') }}">
                    <input type="text" name="year" class="input-field @error('year') border-red-500 @enderror" placeholder="yyyy" maxlength="4"
                        id="year" oninput="this.value=this.value.replace(/[^0-9]/g,'');" value="{{ old('year') }}">
                </div>
                <p class="text-xs text-gray-500 mt-1">Format: DD MM YYYY (numbers only)</p>
                @error('day')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @elseif(@error('month'))
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @elseif(@error('year'))
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @else
                    <p class="text-red-500 text-sm hidden" id="dob_error">Please enter a valid date of birth</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email<span class="text-red-500 ml-0.5">*</span>
                </label>
                <input type="email" name="email" class="input-field @error('email') border-red-500 @enderror" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @else
                    <p class="text-red-500 text-sm hidden" id="email_error">Please enter a valid email address</p>
                @enderror
            </div>
            
            <!-- Phone Number -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Phone Number<span class="text-red-500 ml-0.5">*</span>
                </label>
                <input type="tel" name="phone" class="input-field w-full @error('phone') border-red-500 @enderror" id="phone"
                    oninput="this.value=this.value.replace(/[^0-9+]/g,'');"
                    placeholder="Enter phone number (e.g. +628123456789 or 08123456789)" value="{{ old('phone') }}">
                <p class="text-xs text-gray-500 mt-1">Enter phone number (8-15 digits, may include country code)</p>
                @error('phone')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @else
                    <p class="text-red-500 text-sm hidden" id="phone_error">Please enter a valid phone number (8-15 digits)</p>
                @enderror
            </div>

           <!-- Add On Request -->
           <h2 class="text-xl font-bold mt-6 pt-4 border-t border-gray-200">Add On Request</h2>
           <div class="space-y-2">
               <label class="flex items-center justify-between py-1">
                   <div class="flex items-center gap-2">
                       <input type="checkbox" name="early_checkin" id="early_checkin" class="h-5 w-5 text-teal-600 rounded addon-checkbox" 
                           data-price="350000" {{ old('early_checkin') ? 'checked' : '' }}>
                       <span>Early Check In (11:00 WIB)</span>
                   </div>
                   <span class="text-gray-800 font-medium">Rp. 350.000</span>
               </label>
               <label class="flex items-center justify-between py-1">
                   <div class="flex items-center gap-2">
                       <input type="checkbox" name="late_checkout" id="late_checkout" class="h-5 w-5 text-teal-600 rounded addon-checkbox" 
                           data-price="350000" {{ old('late_checkout') ? 'checked' : '' }}>
                       <span>Late Check Out (15:00 WIB)</span>
                   </div>
                   <span class="text-gray-800 font-medium">Rp. 350.000</span>
               </label>
               <label class="flex items-center justify-between py-1">
                   <div class="flex items-center gap-2">
                       <input type="checkbox" name="extra_bed" id="extra_bed" class="h-5 w-5 text-teal-600 rounded addon-checkbox" 
                           data-price="150000" {{ old('extra_bed') ? 'checked' : '' }}>
                       <span>Extra Bed</span>
                   </div>
                   <span class="text-gray-800 font-medium">Rp. 150.000</span>
               </label>
           </div>

            <!-- Payment Details -->
            <h2 class="text-xl font-bold mb-2">Payment Details</h2>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>{{ $room->room_name }} (<span id="nights-count">1</span> nights)</span>
                    <span id="room-price">Rp. {{ number_format($room->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-1">
                    <span>Request add-on</span>
                    <span id="addons-total">Rp. 0</span>
                </div>
                <div class="flex justify-between py-1">
                    <span>Tax (10%)</span>
                    <span id="tax-amount">Rp. {{ number_format($room->price * 0.1, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold py-1 border-t border-gray-300 mt-1">
                    <span>Total</span>
                    <span id="total-price">Rp. {{ number_format($room->price * 1.1, 0, ',', '.') }}</span>
                </div>
            </div>
            <button type="submit" class="qris-button mt-6 w-full py-3">
                Booking Room
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get booking details from localStorage
    const bookingDetails = {
        checkin: localStorage.getItem('checkinDate') || '{{ date('Y-m-d') }}',
        checkout: localStorage.getItem('checkoutDate') || '{{ date('Y-m-d', strtotime('+1 day')) }}',
        person: localStorage.getItem('personCount') || '02 Person'
    };

    // Display booking details
    const displayCheckin = document.getElementById('display-checkin');
    const displayCheckout = document.getElementById('display-checkout');
    const displayPerson = document.getElementById('display-person');

    document.getElementById('form-checkin').value = bookingDetails.checkin;
    document.getElementById('form-checkout').value = bookingDetails.checkout;
    document.getElementById('form-person').value = bookingDetails.person;
    
    if (displayCheckin && displayCheckout && displayPerson) {
        const checkinDate = new Date(bookingDetails.checkin);
        const checkoutDate = new Date(bookingDetails.checkout);
        
        // Format dates
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        displayCheckin.textContent = checkinDate.toLocaleDateString('en-US', options) + ' (14.00 WIB)';
        displayCheckout.textContent = checkoutDate.toLocaleDateString('en-US', options) + ' (12.00 WIB)';
        displayPerson.textContent = bookingDetails.person;
        
        // Calculate number of nights
        const timeDiff = checkoutDate - checkinDate;
        const nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        document.getElementById('nights-count').textContent = nights;
        
        // Update price calculation
        calculateTotal(nights);
    }

    // Function to calculate total price
    function calculateTotal(nights = 1) {
        const roomPrice = {{ $room->price }};
        const basePrice = roomPrice * nights;
        
        let addonsTotal = 0;
        document.querySelectorAll('.addon-checkbox:checked').forEach(checkbox => {
            addonsTotal += parseInt(checkbox.dataset.price);
        });
        
        const subtotal = basePrice + addonsTotal;
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        // Update display
        document.getElementById('room-price').textContent = 'Rp. ' + basePrice.toLocaleString('id-ID');
        document.getElementById('addons-total').textContent = 'Rp. ' + addonsTotal.toLocaleString('id-ID');
        document.getElementById('tax-amount').textContent = 'Rp. ' + Math.round(tax).toLocaleString('id-ID');
        document.getElementById('total-price').textContent = 'Rp. ' + Math.round(total).toLocaleString('id-ID');
    }
    
    // Event listener for add-on checkboxes
    document.querySelectorAll('.addon-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const nights = parseInt(document.getElementById('nights-count').textContent) || 1;
            calculateTotal(nights);
        });
    });
    
    const form = document.getElementById('bookingForm');
    
    form.addEventListener('submit', function(e) {
        // Only run client-side validation if there are no error messages from Laravel
        if (!document.querySelector('.text-red-500:not(.hidden)')) {
            e.preventDefault();
            let isValid = true;
            
            // Validate First Name
            const firstName = document.getElementById('first_name');
            const firstNameError = document.getElementById('first_name_error');
            if (!firstName.value.trim()) {
                firstName.classList.add('border-red-500');
                firstNameError.classList.remove('hidden');
                isValid = false;
            } else {
                firstName.classList.remove('border-red-500');
                firstNameError.classList.add('hidden');
            }
            
            // Validate Date of Birth
            const day = document.getElementById('day');
            const month = document.getElementById('month');
            const year = document.getElementById('year');
            const dobError = document.getElementById('dob_error');
            
            if (!day.value || !month.value || !year.value || 
                day.value.length !== 2 || month.value.length !== 2 || year.value.length !== 4) {
                day.classList.add('border-red-500');
                month.classList.add('border-red-500');
                year.classList.add('border-red-500');
                dobError.classList.remove('hidden');
                isValid = false;
            } else {
                day.classList.remove('border-red-500');
                month.classList.remove('border-red-500');
                year.classList.remove('border-red-500');
                dobError.classList.add('hidden');
            }
            
            // Validate Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('email_error');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!email.value.trim() || !emailRegex.test(email.value)) {
                email.classList.add('border-red-500');
                emailError.classList.remove('hidden');
                isValid = false;
            } else {
                email.classList.remove('border-red-500');
                emailError.classList.add('hidden');
            }
            
            // Validate Phone Number
            const phone = document.getElementById('phone');
            const phoneError = document.getElementById('phone_error');
            const phoneRegex = /^[\+]?[0-9]{8,15}$/;
            
            if (!phone.value.trim() || !phoneRegex.test(phone.value)) {
                phone.classList.add('border-red-500');
                phoneError.classList.remove('hidden');
                isValid = false;
            } else {
                phone.classList.remove('border-red-500');
                phoneError.classList.add('hidden');
            }
            
            // If all valid, submit the form
            if (isValid) {
                form.submit();
            }
        }
    });
    
    // Add real-time validation on blur
    document.getElementById('first_name').addEventListener('blur', validateFirstName);
    document.getElementById('email').addEventListener('blur', validateEmail);
    document.getElementById('phone').addEventListener('blur', validatePhone);
    
    function validateFirstName() {
        const firstName = document.getElementById('first_name');
        const firstNameError = document.getElementById('first_name_error');
        if (!firstName.value.trim()) {
            firstName.classList.add('border-red-500');
            firstNameError.classList.remove('hidden');
            return false;
        } else {
            firstName.classList.remove('border-red-500');
            firstNameError.classList.add('hidden');
            return true;
        }
    }
    
    function validateEmail() {
        const email = document.getElementById('email');
        const emailError = document.getElementById('email_error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!email.value.trim() || !emailRegex.test(email.value)) {
            email.classList.add('border-red-500');
            emailError.classList.remove('hidden');
            return false;
        } else {
            email.classList.remove('border-red-500');
            emailError.classList.add('hidden');
            return true;
        }
    }
    
    function validatePhone() {
        const phone = document.getElementById('phone');
        const phoneError = document.getElementById('phone_error');
        const phoneRegex = /^[\+]?[0-9]{8,15}$/;
        
        if (!phone.value.trim() || !phoneRegex.test(phone.value)) {
            phone.classList.add('border-red-500');
            phoneError.classList.remove('hidden');
            return false;
        } else {
            phone.classList.remove('border-red-500');
            phoneError.classList.add('hidden');
            return true;
        }
    }
});
</script>
@endsection