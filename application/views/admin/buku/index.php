<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-primary">
            <i class="bi bi-book me-2"></i>Kelola Data Buku
        </h2>
        <p class="text-muted mb-0">Manajemen data buku perpustakaan</p>
    </div>
    <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-2"></i>Tambah Buku
    </a>
</div>

<!-- ================= FILTER ================= -->
<div class="card mb-4 shadow-sm border-0">
    <div class="card-body">
        <form method="GET">
            <div class="row g-2 align-items-center">

                <!-- Search -->
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari judul / pengarang..."
                        value="<?= isset($keyword) ? $keyword : '' ?>">
                </div>

                <!-- Kategori -->
                <div class="col-md-3">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategori_list as $k): ?>
                            <option value="<?= $k['kategori']; ?>"
                                <?= (isset($kategori) && $kategori == $k['kategori']) ? 'selected' : '' ?>>
                                <?= $k['kategori']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Button -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white fw-semibold">
        <i class="bi bi-table me-2"></i>Data Buku
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (empty($buku)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="bi bi-info-circle me-2"></i>Data tidak ditemukan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($buku as $b): ?>
                        <tr>

                            <td><?= $no++ ?></td>

                            <td>
                                <span class="badge bg-primary">
                                    <?= htmlspecialchars($b['kode_buku']) ?>
                                </span>
                            </td>

                            <td class="fw-semibold">
                                <?= htmlspecialchars($b['judul']) ?>
                            </td>

                            <td><?= htmlspecialchars($b['pengarang']) ?></td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= htmlspecialchars($b['kategori'] ?: '-') ?>
                                </span>
                            </td>

                            <td>
                                <?php if ($b['stok'] > 0): ?>
                                    <span class="badge bg-primary">
                                        <?= $b['stok'] ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger">
                                        Habis
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <a href="<?= base_url('buku/edit/' . $b['id']) ?>" 
                                   class="btn btn-sm btn-warning shadow-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= base_url('buku/hapus/' . $b['id']) ?>" 
                                   class="btn btn-sm btn-danger shadow-sm"
                                   onclick="return confirm('Yakin ingin menghapus buku ini?')">
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
/* Card */
.card {
    border-radius: 15px;
}

/* Header */
.page-header h2 {
    letter-spacing: 0.5px;
}

/* Table */
.table thead {
    background-color: #0d6efd;
    color: white;
}

/* Hover efek */
.table-hover tbody tr:hover {
    background-color: #f1f7ff;
    transition: 0.2s;
}

/* Badge */
.badge {
    font-size: 12px;
    padding: 6px 10px;
}

/* Button hover */
.btn:hover {
    transform: translateY(-1px);
    transition: 0.2s;
}
</style>
