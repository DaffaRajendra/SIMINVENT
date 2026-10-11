<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function old($key, $default = '')
{
    static $data = null;
    if ($data === null) {
        $data = $_SESSION['old'] ?? [];
        unset($_SESSION['old']);
    }
    return $data[$key] ?? $default;
}

function setFlash($type, $pesan)
{
    $_SESSION['flash'] = ['type' => $type, 'pesan' => $pesan];
}

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

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

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


function tampilkanPaginasi($page, $totalPages, $keyword)
{
    if ($totalPages <= 1) {
        return;
    }

    $query = $keyword !== '' ? '&amp;q=' . urlencode($keyword) : '';

    echo '<nav aria-label="Navigasi halaman"><ul class="pagination pagination-sm justify-content-center mb-0">';

    $prevOff = $page <= 1 ? ' disabled' : '';
    echo '<li class="page-item' . $prevOff . '"><a class="page-link" href="list.php?page=' . max(1, $page - 1) . $query . '">&laquo;</a></li>';

    for ($i = 1; $i <= $totalPages; $i++) {
        $aktif = $i === $page ? ' active' : '';
        echo '<li class="page-item' . $aktif . '"><a class="page-link" href="list.php?page=' . $i . $query . '">' . $i . '</a></li>';
    }

    $nextOff = $page >= $totalPages ? ' disabled' : '';
    echo '<li class="page-item' . $nextOff . '"><a class="page-link" href="list.php?page=' . min($totalPages, $page + 1) . $query . '">&raquo;</a></li>';

    echo '</ul></nav>';
}
