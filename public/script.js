document.addEventListener("click", function (event) {
    document.querySelectorAll(".action-popup").forEach(popup => {
        popup.style.display = "none"; // Sembunyikan semua popup
    });
});

function showActions(event, id) {
    event.stopPropagation(); // Mencegah klik keluar dari menutup popup sebelum muncul

    let popup = document.getElementById("actionPopup" + id);
    popup.style.display = "block";

    // Tentukan posisi popup sesuai kursor
    popup.style.left = event.pageX + "px";
    popup.style.top = event.pageY + "px";
}

function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        window.location.href = `{{ url('admin/order/printing/hapus/') }}/${id}`;
    }
}
