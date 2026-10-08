<?php
// Jalankan sekali: php migrasi_peminjam.php  (atau buka lewat browser)
require __DIR__ . '/includes/koneksi.php';

$file = __DIR__ . '/../jobsheet-06/data/anggota.json';
$data = json_decode(file_get_contents($file), true);

if (!is_array($data)) {
    die('Gagal membaca anggota.json');
}

$stmt = $pdo->prepare(
    'INSERT INTO peminjam (nim, nama, status, prodi, no_hp, email)
     VALUES (:nim, :nama, :status, :prodi, :no_hp, :email)
     ON CONFLICT (nim) DO NOTHING'          // lewati jika NIM sudah ada
);

try {
    $pdo->beginTransaction();
    $masuk = 0;

    foreach ($data as $a) {
        $stmt->execute([
            'nim'    => $a['no_anggota'],   // no_anggota -> nim
            'nama'   => $a['nama'],
            'status' => 'mahasiswa',        // tidak ada di JSON, pakai nilai bawaan
            'prodi'  => '-',
            'no_hp'  => $a['no_hp'],
            'email'  => '-',
        ]);
        $masuk += $stmt->rowCount();
    }

    $pdo->commit();
    echo "Migrasi selesai: $masuk dari " . count($data) . " data masuk.";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo 'Migrasi gagal: ' . $e->getMessage();
}
