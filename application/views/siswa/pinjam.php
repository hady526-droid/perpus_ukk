<div class="container-fluid py-4">

    <!-- HEADER -->
    <div class="page-header mb-4">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-book me-2"></i>Pinjam Buku
        </h2>
        <p class="text-muted mb-0">Pilih buku yang ingin dipinjam</p>
    </div>

    <div class="row">

        <?php if (empty($buku)): ?>
            <div class="col-12">
                <div class="card shadow-sm border-0 text-center py-5">
                    <i class="bi bi-inbox text-secondary" style="font-size: 50px;"></i>
                    <p class="text-muted mt-3">Tidak ada buku tersedia</p>
                </div>
            </div>
        <?php else: ?>

            <?php foreach ($buku as $b): ?>

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="book-card h-100">

                    <!-- ICON -->
                    <div class="d-flex align-items-start mb-3">
                        <div class="book-icon">
                            <i class="bi bi-book"></i>
                        </div>

                        <div class="ms-3">
                            <span class="badge bg-primary mb-2">
                                <?= htmlspecialchars($b['kode_buku']) ?>
                            </span>

                            <h5 class="mb-1"><?= htmlspecialchars($b['judul']) ?></h5>
                            <p class="text-muted small mb-0">
                                <?= htmlspecialchars($b['pengarang']) ?>
                            </p>
                        </div>
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-2">
                        <?php if ($b['kategori']): ?>
                            <span class="badge bg-light text-dark">
                                <?= htmlspecialchars($b['kategori']) ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($b['tahun_terbit']): ?>
                            <span class="badge bg-light text-dark">
                                <?= $b['tahun_terbit'] ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- DESKRIPSI -->
                    <?php if ($b['deskripsi']): ?>
                        <p class="deskripsi">
                            <?= htmlspecialchars($b['deskripsi']) ?>
                        </p>
                    <?php endif; ?>

                    <!-- FOOTER -->
                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3">

                        <span class="badge bg-success">
                            Stok: <?= $b['stok'] ?>
                        </span>

                        <?php if ($b['stok'] > 0): ?>
                            <a href="<?= base_url('peminjaman/pinjam/' . $b['id']) ?>"
                               class="btn btn-primary btn-sm"
                               onclick="return confirm('Yakin ingin meminjam buku ini?')">
                                <i class="bi bi-cart-plus me-1"></i>Pinjam
                            </a>
                        <?php else: ?>
                            <button class="btn btn-secondary btn-sm" disabled>
                                Stok Habis
                            </button>
                        <?php endif; ?>

                    </div>

                </div>
            </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>

<!-- STYLE -->
<style>
.book-card {
    background: white;
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
}

.book-card:hover {
    transform: translateY(-8px);
}

.book-icon {
    width: 60px;
    height: 80px;
    border-radius: 10px;
    background: linear-gradient(135deg, #4facfe, #00c6ff);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.deskripsi {
    font-size: 13px;
    color: #555;
    margin-top: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>