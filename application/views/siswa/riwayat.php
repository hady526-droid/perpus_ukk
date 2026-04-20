<style>
/* HEADER */
.page-header h2 {
    font-weight: 700;
    color: #1e3a8a;
}

/* CARD */
.card-riwayat {
    border: none;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* EMPTY STATE */
.empty-box {
    text-align: center;
    padding: 60px 20px;
}

.empty-box i {
    font-size: 70px;
    color: #cbd5e1;
    margin-bottom: 15px;
}

.empty-box h5 {
    font-weight: 600;
    color: #374151;
}

.empty-box p {
    color: #6b7280;
}

/* BUTTON */
.btn-biru {
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    border: none;
    color: white;
    padding: 12px 25px;
    border-radius: 12px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-biru:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59,130,246,0.4);
}

/* BIAR LEBIH CENTER */
.center-box {
    min-height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<div class="page-header mb-4">
    <h2><i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman</h2>
    <p class="text-muted">Daftar buku yang pernah dipinjam</p>
</div>

<div class="card card-riwayat">
    <div class="card-body">

        <?php if (empty($riwayat)): ?>

            <!-- EMPTY -->
            <div class="center-box">
                <div class="empty-box">
                    <i class="bi bi-journal-x"></i>
                    <h5>Belum ada riwayat</h5>
                    <p>Kamu belum pernah meminjam buku</p>

                    <a href="<?= base_url('peminjaman') ?>" class="btn btn-biru mt-3">
                        <i class="bi bi-book me-2"></i>Pinjam Buku
                    </a>
                </div>
            </div>

        <?php else: ?>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Tanggal</th>
                            <th>Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td>
                                <strong><?= htmlspecialchars($r['judul']) ?></strong><br>
                                <small class="text-muted"><?= $r['pengarang'] ?></small>
                            </td>

                            <td><?= date('d M Y', strtotime($r['tanggal_pinjam'])) ?></td>
                            <td><?= date('d M Y', strtotime($r['tanggal_kembali'])) ?></td>

                            <td>
                                <?php if ($r['status']=='dipinjam'): ?>
                                    <?php if (strtotime($r['tanggal_kembali']) < time()): ?>
                                        <span class="badge bg-danger">Terlambat</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-success">Selesai</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

    </div>
</div>