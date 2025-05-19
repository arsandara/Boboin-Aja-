@extends('layouts.layout')

@section('content')

<!-- Hero Section -->
<section class="relative">
    <img class="w-full h-96 object-cover" height="600" <img src="{{ asset('images/HEADER.png') }}" width="1920">
    <div
      class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white px-4">
      <h1 class="text-4xl font-bold">
        More Than a Stay,
        <br>
        It’s Where You Find Peace
      </h1>
      <p class="mt-4">
        Find your perfect stay, where modern comfort meets serene tranquility.
        <br>
        Recharge, unwind, and experience peace like never before.
      </p>
      <!-- Booking Form - Sama di semua halaman -->
      <div class="mt-6 bg-white text-black rounded-lg shadow-lg p-4">
          <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-4">
              <!-- Check In -->
              <div class="w-full md:w-auto">
                  <label class="block text-sm font-medium text-right md:text-left" for="checkin">
                      Check In
                  </label>
                  <input class="mt-1 block w-full border-gray-300 rounded-md" id="checkin" type="date" required>
              </div>

              <!-- Check Out -->
              <div class="w-full md:w-auto">
                  <label class="block text-sm font-medium text-right md:text-left" for="checkout">
                      Check Out
                  </label>
                  <input class="mt-1 block w-full border-gray-300 rounded-md" id="checkout" type="date" required>
              </div>
              
              <!-- Person -->
              <div class="w-full md:w-auto">
                  <label class="block text-sm font-medium text-right md:text-left" for="person">
                      Person
                  </label>
                  <select class="mt-1 block w-full border-gray-300 rounded-md" id="person" required>
                      <option value="01 Person">01 Person</option>
                      <option value="02 Person" selected>02 Person</option>
                      <option value="03 Person">03 Person</option>
                      <option value="04 Person">04 Person</option>
                  </select>
              </div>
              
              <!-- Available Room Button -->
              <div class="w-full md:w-auto text-center md:text-right mt-4 md:mt-0">
              <a href="{{ url('/rooms') }}" class="inline-block bg-teal-900 text-white px-6 py-2 rounded-md">
                    Available Room
                  </a>
                  </script>
                </div>
              </div>
            </section>

  <!-- Cabin Filters -->
    <div class="container mx-auto my-8 px-6">
        <div class="flex space-x-2 mb-6 overflow-x-auto">
            <button class="bg-teal-900 text-white px-4 py-2 rounded" onclick="filterCabins('all')">All</button>
            <button class="bg-white border border-gray-300 px-4 py-2 rounded" onclick="filterCabins('family')">Family</button>
            <button class="bg-white border border-gray-300 px-4 py-2 rounded" onclick="filterCabins('pet_friendly')">Pet Friendly</button>
            <button class="bg-white border border-gray-300 px-4 py-2 rounded" onclick="filterCabins('romantic')">Romantic</button>
        </div>
        <script>
        function filterCabins(type) {
            const cabins = document.querySelectorAll('.cabin-card');
        
            cabins.forEach(cabin => {
                const roomType = cabin.getAttribute('data-room-type');
                if (type === 'all') {
                    cabin.style.display = 'block';
                } else {
                    cabin.style.display = (roomType === type) ? 'block' : 'none';
                }
            });
        
            // Update tombol aktif
            const filterButtons = document.querySelectorAll('.container > .flex > button');
            filterButtons.forEach(button => {
                const filterType = button.getAttribute('onclick').replace("filterCabins('", "").replace("')", "");
                if (filterType === type) {
                    button.classList.remove('bg-white', 'border-gray-300');
                    button.classList.add('bg-teal-900', 'text-white');
                } else {
                    button.classList.remove('bg-teal-900', 'text-white');
                    button.classList.add('bg-white', 'border', 'border-gray-300');
                }
            });
        }

        // Set default filter 'All' saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            filterCabins('all');
        });
        </script>

        <!-- Cabin Listings -->
        <div class="space-y-6">
            <?php foreach ($rooms as $room): ?>
            <div class="cabin-card bg-white rounded-lg shadow-md overflow-hidden mb-8"
                data-room-type="<?php echo htmlspecialchars($room['room_type']); ?>">
                <div class="relative">
                <img src="{{ asset('storage/' . $room->image_booking) }}" 
                    alt="{{ $room->room_name }}" class="w-full h-96 object-cover">
                    <!-- Tags berdasarkan tipe kamar -->
                    <div class="absolute top-4 right-4 flex space-x-2">
                        <?php if ($room['room_type'] === 'Standard'): ?>
                            <span class="tag-pill tag-standard bg-red-500 text-white px-3 py-1 rounded-full text-sm">Standard</span>
                        <?php elseif ($room['room_type'] === 'Family'): ?>
                            <span class="tag-pill tag-family bg-green-500 text-white px-3 py-1 rounded-full text-sm">Family</span>
                        <?php elseif ($room['room_type'] === 'Pet Friendly'): ?>
                            <span class="tag-pill tag-pet bg-yellow-500 text-white px-3 py-1 rounded-full text-sm">Pet Friendly</span>
                        <?php elseif ($room['room_type'] === 'Romantic'): ?>
                            <span class="tag-pill tag-romantic bg-pink-500 text-white px-3 py-1 rounded-full text-sm">Romantic</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-900"><?php echo htmlspecialchars($room['room_name']); ?></h3>
                    
                    <div class="flex items-center mt-3 flex-wrap gap-4">
                        <div class="flex items-center text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="ml-1 text-gray-800 font-medium"><?php echo htmlspecialchars($room['rating'] ?? '4.8'); ?></span>
                        </div>
                        
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-user mr-1"></i>
                            <span><?php echo htmlspecialchars($room['capacity']); ?> people</span>
                        </div>
                        
                        <?php if ($room['breakfast_included']): ?>
                        <div class="flex items-center text-gray-700">
                            <i class="fas fa-coffee mr-1"></i>
                            <span>Breakfast</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <p class="text-2xl font-bold text-gray-900"><?php echo formatRupiah($room['price']); ?></p>
                        
                        <form action="booking.php" method="GET">
                            <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                            <button type="submit" class="book-now-btn text-sm bg-teal-900 text-white px-3 py-2 rounded">
                                Book Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- WhatsApp, Social Media, and Map (Two Columns) -->
    <div class="mt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="flex flex-col space-y-6">
                <!-- WhatsApp -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md flex flex-col items-center text-center">
                    <div class="bg-white p-4 rounded-full shadow-lg">
                        <i class="fab fa-whatsapp text-4xl text-green-500"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">Chat to Admin</h3>
                    <p class="text-gray-600 text-sm">Speak to our friendly team.</p>
                    <a href="https://wa.me/081234567891" class="mt-2 text-blue-600 underline">wa.me/081234567891</a>
                </div>

                <!-- Social Media -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <h3 class="text-lg font-semibold">Social Media</h3>
                    <p class="text-gray-600 text-sm">Get to know us more.</p>
                    <div class="flex justify-center space-x-4 mt-4">
                        <a href="#" class="text-black text-2xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-black text-2xl"><i class="fab fa-x"></i></a>
                        <a href="#" class="text-black text-2xl"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div>
                <iframe class="w-full h-full rounded-lg shadow-md"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.203351538528!2d109.23085717476867!3d-7.550198674634177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559cb2b7a3e4f%3A0x301e8f1fc28ff20!2sBaturaden%2C%20Banyumas%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1617045959045!5m2!1sen!2sid"
                  allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Address Section -->
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Find Boboin.Aja</h3>
            <p class="text-gray-600"><strong>Address:</strong></p>
            <p class="text-gray-600 text-sm">Jl. Pancuran 7, Hamlet III Berubahan, Kemutug Lor, Baturaden District,
                Banyumas Regency, Central Java, Baturaden, Purwokerto, Indonesia, 53151</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Set tanggal hari ini dan besok
        const today = new Date();
        const tomorrow = new Date();
        tomorrow.setDate(today.getDate() + 1);

        // Format ke yyyy-mm-dd
        const formatDate = (date) => {
            return date.toISOString().split('T')[0];
        };

        document.getElementById('checkin').value = formatDate(today);
        document.getElementById('checkout').value = formatDate(tomorrow);
    });
</script>
@endsection

@section('scripts')
    <script src="{{ asset('js/dateSync.js') }}"></script>
@endsection