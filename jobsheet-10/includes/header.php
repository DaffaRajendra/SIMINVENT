<?php
require_once __DIR__ . '/helpers.php';

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$active = $active ?? '';
$sudahLogin = isset($_SESSION['user_id']);
function navActive($menu, $active)
{
    return str_starts_with($active, $menu) ? ' active' : '';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMINVENT-Mini<?= isset($page_title) ? ' | ' . e($page_title) : '' ?></title>
    <link rel="icon" href="<?= $base ?>assets/img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-xl bg-white border-bottom sticky-top py-0">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold me-0 py-3" href="<?= $base ?>index.php">
                <img src="<?= $base ?>assets/img/logo.png" alt="Logo SIMINVENT" height="40" class="me-2">
                SIMINVENT<span class="text-primary fw-normal">-Mini</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('beranda', $active) ?>" href="<?= $base ?>index.php"><i class="bi bi-house-door me-1"></i>Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('barang', $active) ?>" href="<?= $base ?>barang/list.php"><i class="bi bi-box-seam me-1"></i>Barang</a>
                    </li>
                    <?php if ($sudahLogin): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= navActive('peminjam', $active) ?>" href="<?= $base ?>peminjam/list.php"><i class="bi bi-people me-1"></i>Peminjam</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="aksi-navbar d-grid d-xl-flex align-items-xl-center gap-2 pb-3 pb-xl-0">
                    <?php if ($sudahLogin): ?>
                    <a class="btn btn-outline-primary rounded-pill text-nowrap" href="<?= $base ?>barang/tambah.php"><i class="bi bi-plus-lg"></i> Tambah Barang</a>
                    <a class="btn btn-primary rounded-pill text-nowrap" href="<?= $base ?>peminjam/tambah.php"><i class="bi bi-person-plus"></i> Tambah Peminjam</a>
                    <span class="small text-secondary text-nowrap px-xl-2"><i class="bi bi-person-circle"></i> <?= e($_SESSION['nama']) ?></span>
                    <a class="btn btn-outline-secondary rounded-pill text-nowrap" href="<?= $base ?>auth/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    <?php else: ?>
                    <a class="btn btn-primary rounded-pill text-nowrap" href="<?= $base ?>auth/login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
