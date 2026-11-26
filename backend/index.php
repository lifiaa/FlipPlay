<?php
require_once __DIR__ . '/src/Media.php';
require_once __DIR__ . '/src/Movie.php';
require_once __DIR__ . '/src/Series.php';
require_once __DIR__ . '/src/User.php';
require_once __DIR__ . '/src/Library.php';

use App\Movie;
use App\Series;
use App\User;
use App\Library;

$library = new Library();

echo "================================" . PHP_EOL;
echo "       FLIPPLAY SIMULATION       " . PHP_EOL;
echo "================================" . PHP_EOL;

$name = trim(readline("Masukkan nama pengguna: "));
$user = new User($name);
$jumlah = (int) readline("Jumlah media yang ingin ditambahkan: ");

// Perulangan untuk memasukkan data media.
for ($i = 1; $i <= $jumlah; $i++) {

    echo PHP_EOL;
    echo "=== INPUT MEDIA KE-$i ===" . PHP_EOL;
    echo "1. Movie" . PHP_EOL;
    echo "2. Series" . PHP_EOL;

    // if($jenis >= 1 && $jenis <= 2){
    $jenis = trim(readline("Pilih jenis media (1/2): "));
    $title = trim(readline("Judul: "));
    $creator = trim(readline("Creator: "));
    $description = trim(readline("Deskripsi: "));
   

    // Membuat objek berdasarkan jenis media.
    if ($jenis === "1") {
        $duration = (int) readline("Durasi (menit): ");
        $media = new Movie(
            $title,
            $creator,
            $description,
            $duration
        );
    } elseif ($jenis === "2") {
        $episodes = (int) readline("Jumlah episode: ");
        $media = new Series(
            $title,
            $creator,
            $description,
            $episodes
        );
    } else {
        echo "Jenis media tidak valid!" . PHP_EOL;
        $i--;
        continue;
    }
    
    // SIMULASI 1
    // Menambahkan objek Movie atau Series ke Library.
    $library->addMedia($media);

    // Menanyakan apakah media ingin masuk koleksi User.
    $simpan = strtolower(trim(
        readline("Tambahkan ke koleksi pengguna? (y/n): ")
    ));

    if ($simpan === "y") {
        $user->addToCollection($media);
    }
    echo "Media berhasil ditambahkan!" . PHP_EOL;
}

// SIMULASI 2
// Menampilkan daftar media yang sudah dimasukkan.
echo PHP_EOL;
$library->showAllMedia();

// SIMULASI 3
// Mencari media berdasarkan input judul.
echo PHP_EOL;
echo "=== SEARCH MEDIA ===" . PHP_EOL;

$keyword = trim(readline("Masukkan judul yang dicari: "));

$result = $library->searchMedia($keyword);

if ($result !== null) {
    echo "Found: " . $result->getTitle() . PHP_EOL;
} else {
    echo "Media not found." . PHP_EOL;
}

// SIMULASI 4
// Menampilkan detail media berdasarkan input judul.
echo PHP_EOL;
echo "=== MEDIA DETAIL ===" . PHP_EOL;

$detailTitle = trim(readline("Masukkan judul untuk melihat detail: "));

$library->showMediaDetail($detailTitle);

// SIMULASI 5
// Menampilkan koleksi media milik pengguna.
echo PHP_EOL;
echo "=== USER COLLECTION ===" . PHP_EOL;

$user->showCollection();
