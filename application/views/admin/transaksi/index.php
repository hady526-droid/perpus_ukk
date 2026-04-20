<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2><i class="bi bi-arrow-left-right me-2"></i>Kelola Transaksi</h2>
        <p class="text-muted mb-0">Manajemen transaksi peminjaman buku</p>
    </div>
    <a href="<?= base_url('transaksi/tambah') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Transaksi Baru
    </a>
</div>

<!-- ================= FILTER ================= -->
<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <form method="GET">
            <div class="row">

                <!-- SEARCH -->
                <div class="col-md-3 mb-2">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari anggota / buku..."
                        value="<?= isset($keyword) ? $keyword : '' ?>">
                </div>

                <!-- STATUS -->
                <div class="col-md-3 mb-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="dipinjam" <?= ($status=='dipinjam')?'selected':'' ?>>Dipinjam</option>
                        <option value="dikembalikan" <?= ($status=='dikembalikan')?'selected':'' ?>>Dikembalikan</option>
                    </select>
                </div>

                <!-- TANGGAL -->
                <div class="col-md-3 mb-2">
                    <input type="date" name="tanggal" class="form-control"
                        value="<?= isset($tanggal) ? $tanggal : '' ?>">
                </div>

                <!-- BUTTON -->
                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>

                <div class="col-md-1 mb-2">
                    <a href="<?= base_url('transaksi') ?>" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Batas Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($transaksi)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($transaksi as $t): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <!-- ANGGOTA -->
                            <td>
                                <strong><?= htmlspecialchars($t['nama']) ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars($t['nis']) ?></small>
                            </td>

                            <!-- BUKU -->
                            <td>
                                <?= htmlspecialchars($t['judul']) ?><br>
                                <small class="text-muted"><?= htmlspecialchars($t['kode_buku']) ?></small>
                            </td>

                            <!-- TANGGAL -->
                            <td><?= date('d/m/Y', strtotime($t['tanggal_pinjam'])) ?></td>
                            <td><?= date('d/m/Y', strtotime($t['tanggal_kembali'])) ?></td>

                            <!-- STATUS -->
                            <td>
                                <?php if ($t['status'] == 'dipinjam'): ?>
                                    <?php if (strtotime($t['tanggal_kembali']) < strtotime(date('Y-m-d'))): ?>
                                        <span class="badge bg-danger">Terlambat</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-success">Dikembalikan</span>

                                    <?php if (isset($t['denda']) && $t['denda'] > 0): ?>
                                        <br>
                                        <small class="text-danger">
                                            Denda: Rp <?= number_format($t['denda'], 0, ',', '.') ?>
                                        </small>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <?php if ($t['status'] == 'dipinjam'): ?>
                                    <a href="<?= base_url('transaksi/konfirmasi/' . $t['id']) ?>" 
                                       class="btn btn-sm btn-success"
                                       onclick="return confirm('Konfirmasi pengembalian buku?')">
                                        <i class="bi bi-check-circle"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= base_url('transaksi/detail/' . $t['id']) ?>" 
                                   class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="<?= base_url('transaksi/hapus/' . $t['id']) ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- ================= STYLE ================= -->
<style>
.card {
    border-radius: 15px;
    border: none;
}

.table thead {
    background: #0d6efd;
    color: white;
}

.badge {
    font-size: 12px;
}

.btn {
    border-radius: 8px;
}
</style>