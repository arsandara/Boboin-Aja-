document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen input
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const personSelect = document.getElementById('person');

    // Fungsi untuk menyimpan data ke localStorage
    function saveBookingData() {
        localStorage.setItem('checkinDate', checkinInput.value);
        localStorage.setItem('checkoutDate', checkoutInput.value);
        localStorage.setItem('personCount', personSelect.value);
        console.log("Saved booking data:", {
            checkinDate: checkinInput.value,
            checkoutDate: checkoutInput.value,
            personCount: personSelect.value
        });
    }

    // Fungsi untuk memuat data dari localStorage
    function loadBookingData() {
        const savedCheckin = localStorage.getItem('checkinDate');
        const savedCheckout = localStorage.getItem('checkoutDate');
        const savedPerson = localStorage.getItem('personCount');

        console.log("Loaded booking data:", {
            savedCheckin,
            savedCheckout,
            savedPerson
        });

        // Jika data ada di localStorage, set nilai pada input
        if (savedCheckin && checkinInput) {
            checkinInput.value = savedCheckin;
        }
        if (savedCheckout && checkoutInput) {
            checkoutInput.value = savedCheckout;
        }
        if (savedPerson && personSelect) {
            personSelect.value = savedPerson;
        }
    }

    // Cek apakah elemen input ada di halaman ini
    if (checkinInput && checkoutInput && personSelect) {
        loadBookingData();  // Memuat data saat halaman dimuat

        checkinInput.addEventListener('change', saveBookingData);
        checkoutInput.addEventListener('change', saveBookingData);
        personSelect.addEventListener('change', saveBookingData);
    } else {
        loadBookingData();  // Memuat data jika elemen tidak ada di halaman ini
    }

    // Set nilai dan batas minimum untuk tanggal check-in dan check-out
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);

    const formatDate = (date) => {
        return date.toISOString().split('T')[0];
    };

    checkinInput.value = formatDate(today);
    checkinInput.min = formatDate(today);  // Set batas minimum ke hari ini (tidak bisa memilih kemarin)

    checkoutInput.value = formatDate(tomorrow);
    checkoutInput.min = formatDate(tomorrow);  // Set batas minimum untuk checkout ke besok

    // Update checkout minimum saat checkin diubah
    checkinInput.addEventListener('change', function () {
        const selectedCheckin = new Date(this.value);
        const newMinCheckout = new Date(selectedCheckin);
        newMinCheckout.setDate(selectedCheckin.getDate() + 1);

        checkoutInput.min = formatDate(newMinCheckout);
        if (new Date(checkoutInput.value) <= selectedCheckin) {
            checkoutInput.value = formatDate(newMinCheckout);
        }
    });
});
