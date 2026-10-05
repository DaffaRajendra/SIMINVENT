<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Membungkus output data yang berasal dari input pengguna sebelum
// dicetak ke HTML, untuk mencegah XSS (Cross-Site Scripting).
function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

// Ambil isian lama (old input) setelah validasi gagal, supaya form
// tidak perlu diisi ulang dari awal. Session di-clear sekali pakai
// lewat static var, jadi tidak akan "nyangkut" di kunjungan berikutnya.
function old($key, $default = '')
{
    static $data = null;
    if ($data === null) {
        $data = $_SESSION['old'] ?? [];
        unset($_SESSION['old']);
    }
    return $data[$key] ?? $default;
}

// Simpan pesan flash (sukses/error) ke session. $pesan boleh string
// tunggal atau array of string (dipakai saat error validasi > 1).
function setFlash($type, $pesan)
{
    $_SESSION['flash'] = ['type' => $type, 'pesan' => $pesan];
}

// Tampilkan pesan flash lalu langsung hapus dari session, supaya
// tidak muncul lagi kalau halaman di-refresh.
function tampilkanFlash()
{
    if (empty($_SESSION['flash'])) {
        return;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    $daftarPesan = is_array($flash['pesan']) ? $flash['pesan'] : [$flash['pesan']];
    $cssClass = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';

    echo '<div class="alert ' . $cssClass . '">';
    if (count($daftarPesan) > 1) {
        echo '<ul class="mb-0">';
        foreach ($daftarPesan as $pesan) {
            echo '<li>' . e($pesan) . '</li>';
        }
        echo '</ul>';
    } else {
        echo e($daftarPesan[0]);
    }
    echo '</div>';
}

// Redirect ke halaman lain (path relatif terhadap file yang memanggil)
// lalu hentikan eksekusi. Dipakai untuk pola PRG (Post/Redirect/Get).
function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

// Format tanggal ke gaya Indonesia. Menerima Unix timestamp (int)
// maupun string tanggal dari database (mis. "2026-09-22").
function tanggalIndonesia($tanggal)
{
    $namaBulan = [
        '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
    ];

    $timestamp = is_numeric($tanggal) ? (int) $tanggal : strtotime((string) $tanggal);
    if ($timestamp === false) {
        return '-';
    }

    $tgl = (int) date('j', $timestamp);
    $bln = (int) date('n', $timestamp);
    $thn = date('Y', $timestamp);

    return $tgl . ' ' . $namaBulan[$bln] . ' ' . $thn;
}
