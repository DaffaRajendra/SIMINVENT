<div class="bg-white border-bottom py-3">
    <div class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb small mb-1">
                        <li class="breadcrumb-item"><a href="<?= $base ?>index.php" class="text-decoration-none">Home</a></li>
                        <?php foreach ($crumb as $teks => $link): ?>
                            <?php if ($link): ?>
                        <li class="breadcrumb-item"><a href="<?= e($link) ?>" class="text-decoration-none"><?= e($teks) ?></a></li>
                            <?php else: ?>
                        <li class="breadcrumb-item active"><?= e($teks) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ol>
                </nav>
                <h1 class="h3 fw-bold mb-0"><?= e($page_title) ?></h1>
            </div>
            <?php if (!empty($tombol)): ?>
            <a href="<?= e($tombol['href']) ?>" class="btn btn-primary"><i class="bi bi-<?= e($tombol['ikon']) ?>"></i> <?= e($tombol['teks']) ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
