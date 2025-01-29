@if (session('invoice_path'))
    <script>
        window.onload = function() {
            window.location.href = "{{ url('download/invoice') }}";
        };
    </script>
@endif

@if (session('success'))
    <div id="alert-success" class="alert alert-success text-center" role="alert">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="alert-error" class="alert alert-danger text-center" role="alert">
        <strong>Error!</strong> {{ session('error') }}
    </div>
@endif

<style>
    /* Alert Sukses */
    #alert-success,
    #alert-error {
        position: fixed;
        bottom: -100px; /* Awalnya tersembunyi */
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 90%; /* Sesuaikan lebar */
        max-width: 400px; /* Maksimal lebar alert */
        padding: 10px 15px;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: bottom 0.5s ease-in-out; /* Animasi smooth */
    }

    #alert-success {
        background-color: #d4edda; /* Hijau untuk sukses */
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    /* Alert Gagal */
    #alert-error {
        background-color: #f8d7da; /* Merah untuk error */
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Saat muncul */
    #alert-success.show,
    #alert-error.show {
        bottom: 20px; /* Posisi akhir saat muncul */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertSuccess = document.getElementById('alert-success');
        const alertError = document.getElementById('alert-error');

        // Fungsi untuk memunculkan dan menghilangkan alert
        const showAlert = (alertElement) => {
            if (alertElement) {
                setTimeout(() => {
                    alertElement.classList.add('show'); // Menambahkan kelas 'show'
                }, 100);

                setTimeout(() => {
                    alertElement.classList.remove('show'); // Menghilangkan kelas 'show'
                }, 4000); // 4 detik

                setTimeout(() => {
                    alertElement.remove(); // Menghapus elemen dari DOM
                }, 4500); // 4.5 detik
            }
        };

        // Eksekusi alert sukses
        showAlert(alertSuccess);

        // Eksekusi alert gagal
        showAlert(alertError);
    });
</script>
