<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($teks)
{
    return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function setFlash($type, $pesan)
{
    $_SESSION['flash'] = ['type' => $type, 'pesan' => (array) $pesan];
}

function tampilkanFlash()
{
    if (empty($_SESSION['flash'])) {
        return;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    $kelas = $flash['type'] === 'success' ? 'alert-success' : 'alert-danger';
    echo '<div class="alert ' . $kelas . '" role="alert">';
    if (count($flash['pesan']) === 1) {
        echo e($flash['pesan'][0]);
    } else {
        echo '<ul class="mb-0">';
        foreach ($flash['pesan'] as $pesan) {
            echo '<li>' . e($pesan) . '</li>';
        }
        echo '</ul>';
    }
    echo '</div>';
}

function old($key)
{
    static $data = null;
    if ($data === null) {
        $data = $_SESSION['old'] ?? [];
        unset($_SESSION['old']);
    }
    return $data[$key] ?? '';
}

function tanggalIndonesia($timestamp)
{
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
              'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return date('j', $timestamp) . ' ' . $bulan[(int) date('n', $timestamp) - 1] . ' ' . date('Y', $timestamp);
}
