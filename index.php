<?php
// Membuat array dua dimensi
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

// Menambah elemen baru
$matrix[0][] = 10; // Menambah 10 di baris pertama
$matrix[] = [11, 12, 13]; // Menambah baris baru

// Mengubah elemen
$matrix[1][2] = 16; // Mengubah elemen di baris kedua kolom ketiga menjadi 16

// Menghapus elemen
unset($matrix[2][1]); // Menghapus elemen di baris ketiga kolom kedua

// Menampilkan array setelah manipulasi
foreach ($matrix as $row) {
    foreach ($row as $element) {
        echo $element . " ";
    }
    echo "<br>";
}
?>
