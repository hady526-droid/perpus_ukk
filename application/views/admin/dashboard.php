<!-- ================= HEADER ================= -->
<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</h2>
        <p class="text-muted mb-0">Selamat datang di panel administrasi perpustakaan</p>
    </div>
    <div>
        <span class="badge bg-primary p-2">
            <i class="bi bi-calendar me-1"></i><?= date('d F Y') ?>
        </span>
    </div>
</div>

<!-- ================= ID CARD ================= -->
<div class="card id-card mb-4">
    <div class="card-body d-flex align-items-center">

        <div class="avatar me-3">
            <i class="bi bi-person-fill"></i>
        </div>

        <div>
            <h5 class="mb-1"><?= $this->session->userdata('username') ?></h5>
            <small>Administrator</small>
        </div>

        <div class="ms-auto text-end">
            <span class="badge bg-success">Online</span>
            <div id="jam" class="small mt-1"></div>
        </div>

    </div>
</div>

<!-- ================= STATISTIK ================= -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card p-3">
            <i class="bi bi-book icon"></i>
            <h4><?= $total_buku ?></h4>
            <p>Total Buku</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card p-3">
            <i class="bi bi-people icon"></i>
            <h4><?= $total_anggota ?></h4>
            <p>Total Anggota</p>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="stat-card p-3">
            <i class="bi bi-arrow-left-right icon"></i>
            <h4><?= $total_peminjaman ?></h4>
            <p>Peminjaman Aktif</p>
        </div>
    </div>
</div>

<!-- ================= AKSI CEPAT ================= -->
<div class="card mb-4">
    <div class="card-header">Aksi Cepat</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 mb-2">
                <a href="<?= base_url('buku/tambah') ?>" class="btn btn-primary w-100">Tambah Buku</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary w-100">Tambah Anggota</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="<?= base_url('transaksi/tambah') ?>" class="btn btn-primary w-100">Transaksi</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="<?= base_url('transaksi') ?>" class="btn btn-primary w-100">Lihat</a>
            </div>
        </div>
    </div>
</div>

<!-- ================= GRAFIK ================= -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">Grafik Peminjaman</div>
            <div class="card-body">
                <canvas id="chart1"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">Status</div>
            <div class="card-body">
                <canvas id="chart2"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- ================= TRANSAKSI ================= -->
<div class="card">
    <div class="card-header">Transaksi Terbaru</div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peminjaman_terbaru as $p): ?>
                <tr>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['judul'] ?></td>
                    <td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
                    <td>
                        <span class="badge bg-primary"><?= $p['status'] ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ================= SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// jam realtime
setInterval(() => {
    document.getElementById('jam').innerText =
        new Date().toLocaleTimeString('id-ID');
}, 1000);

// chart
new Chart(document.getElementById('chart1'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr'],
        datasets: [{
            data: [10,20,15,25],
            backgroundColor: '#0d6efd'
        }]
    }
});

new Chart(document.getElementById('chart2'), {
    type: 'doughnut',
    data: {
        labels: ['Dipinjam','Kembali'],
        datasets: [{
            data: [<?= $total_peminjaman ?>, 5],
            backgroundColor: ['#0d6efd','#6ea8fe']
        }]
    }
});
</script>

<!-- ================= STYLE ================= -->
<style>
:root {
    --blue: #0d6efd;
}

/* card */
.card {
    border-radius: 15px;
}

/* header */
.card-header {
    background: var(--blue);
    color: white;
}

/* id card */
.id-card {
    background: linear-gradient(135deg,#0d6efd,#3a8bfd);
    color: white;
    border-radius: 15px;
}

.avatar {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* statistik */
.stat-card {
    background: #e7f1ff;
    border-left: 5px solid var(--blue);
    border-radius: 15px;
    text-align:center;
}

.stat-card .icon {
    font-size: 25px;
    color: var(--blue);
}

/* table */
.table thead {
    background: var(--blue);
    color: white;
}
</style>