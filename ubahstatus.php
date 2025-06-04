<?php
    // Koneksi ke database
    $konek = mysqli_connect("localhost", "root", "", "bell");

    // Mengecek apakah koneksi berhasil
    if (!$konek) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Update status dari 0 menjadi 1
    $sql = mysqli_query($konek, "UPDATE jam SET status=2 WHERE status=1");

    // Mengecek apakah query berhasil dijalankan
    if ($sql) {
        echo "Status berhasil diubah dari 0 ke 1.";
    } else {
        echo "Error: " . mysqli_error($konek);
    }

    // Menutup koneksi
    mysqli_close($konek);
?>
