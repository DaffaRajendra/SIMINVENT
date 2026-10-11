<?php
require_once __DIR__ . '/../includes/helpers.php';

if (isset($_SESSION['user_id'])) {
    redirect('../index.php');
}

$page_title = "Login Petugas";
$active = "login";
include __DIR__ . '/../includes/header.php';

$crumb = ['Login' => null];
include __DIR__ . '/../includes/judul_halaman.php';
?>
<main class="container py-5 flex-grow-1">
    <?php tampilkanFlash(); ?>

    <div class="row">
        <div class="col-md-6 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <form method="post" action="proses_login.php">
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control py-2" id="username" name="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control py-2" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                    </form>
                    <p class="text-center small text-secondary mt-3 mb-0">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>