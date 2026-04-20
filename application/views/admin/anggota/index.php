<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-primary"><i class="bi bi-people me-2"></i>Kelola Anggota</h2>
        <p class="text-muted mb-0">Manajemen data anggota</p>
    </div>
    <div>
        <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary">
            <i class="bi bi-person-plus me-2"></i>Tambah Anggota
        </a>
    </div>
</div>

<!-- ================= FILTER ================= -->
<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari nama / NIS..."
                        value="<?= isset($keyword) ? htmlspecialchars($keyword) : '' ?>">
                </div>
                <div class="col-md-2 mb-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
                <div class="col-md-2 mb-2">
                    <a href="<?= base_url('anggota') ?>" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm">
    <div class="card-header">
        Data Anggota
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(empty($anggota)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php $no=1; foreach($anggota as $a): ?>
                        <tr>
                            <td><?= $no++ ?></td>

                            <td><?= htmlspecialchars($a['nama']) ?></td>

                            <td>
                                <span class="badge bg-primary">
                                    <?= htmlspecialchars($a['nis']) ?>
                                </span>
                            </td>

                            <td><?= !empty($a['alamat']) ? htmlspecialchars($a['alamat']) : '-' ?></td>
                            <td><?= !empty($a['telepon']) ? htmlspecialchars($a['telepon']) : '-' ?></td>

                            <td>
                                <a href="<?= base_url('anggota/edit/'.$a['id']) ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= base_url('anggota/hapus/'.$a['id']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus?')">
                                    <i class="bi bi-trash"></i>
                                </a>

                                <button type="button" 
                                        class="btn btn-info btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalIdCard"
                                        data-nama="<?= htmlspecialchars($a['nama']) ?>"
                                        data-nis="<?= htmlspecialchars($a['nis']) ?>"
                                        data-alamat="<?= htmlspecialchars($a['alamat'] ?? '-') ?>"
                                        data-telepon="<?= htmlspecialchars($a['telepon'] ?? '-') ?>">
                                    <i class="bi bi-credit-card"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="modalIdCard" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 bg-transparent">
            <div class="modal-body text-center">
                <div id="idCardContainer"></div>
            </div>
        </div>
    </div>
</div>

<!-- ================= STYLE ================= -->
<style>
.card {
    border-radius: 15px;
    border: none;
}

.card-header {
    background: linear-gradient(135deg, #2196f3, #0d47a1);
    color: white;
}

.table thead {
    background: linear-gradient(135deg, #2196f3, #0d47a1);
    color: white;
}

/* ID CARD */
.id-card {
    width: 300px;
    border-radius: 18px;
    padding: 20px;
    margin: auto;
    color: white;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #2196f3, #0d47a1);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

.avatar {
    width: 70px;
    height: 70px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    line-height: 70px;
    font-size: 28px;
    margin: 15px auto;
    font-weight: bold;
}

.nama {
    font-weight: bold;
    text-transform: uppercase;
    font-size: 18px;
}

.nis {
    font-size: 13px;
}

.detail {
    font-size: 12px;
    text-align: left;
    margin-top: 10px;
}

.btn-print {
    background: white;
    color: #0d47a1;
    border-radius: 10px;
    font-size: 12px;
}

/* PRINT */
@media print {
    body * {
        visibility: hidden;
    }
    #idCardContainer, #idCardContainer * {
        visibility: visible;
    }
    #idCardContainer {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- ================= SCRIPT ================= -->
<script>
document.getElementById('modalIdCard').addEventListener('show.bs.modal', function(event) {
    const btn = event.relatedTarget;

    const nama = btn.getAttribute('data-nama');
    const nis = btn.getAttribute('data-nis');
    const alamat = btn.getAttribute('data-alamat');
    const telepon = btn.getAttribute('data-telepon');

    const inisial = nama.charAt(0).toUpperCase();

    document.getElementById('idCardContainer').innerHTML = `
        <div class="id-card">

            <div>KARTU ANGGOTA</div>

            <div class="avatar">${inisial}</div>

            <div class="nama">${nama}</div>
            <div class="nis">NIS: ${nis}</div>

            <div class="detail">
                <p><b>Alamat:</b> ${alamat}</p>
                <p><b>Telepon:</b> ${telepon}</p>
            </div>

            <button onclick="window.print()" class="btn btn-print mt-3">
                🖨 Cetak
            </button>

        </div>
    `;
});
</script>