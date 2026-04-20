<div class="container mt-4">

<h3><i class="bi bi-file-earmark-text"></i> Laporan Transaksi</h3>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
                </div>
                <div class="col-md-4">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>">
                </div>
                <div class="col-md-4 mt-4">
                    <button class="btn btn-primary">Filter</button>
                    <a href="<?= base_url('transaksi/laporan') ?>" class="btn btn-secondary">Reset</a>

                    <a target="_blank"
                       href="<?= base_url('transaksi/cetak_laporan?tanggal_awal='.$tanggal_awal.'&tanggal_akhir='.$tanggal_akhir) ?>"
                       class="btn btn-success">
                       🖨 Cetak
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
<div class="card-body">
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Buku</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Denda</th>
    </tr>

    <?php if(empty($laporan)): ?>
        <tr>
            <td colspan="6" class="text-center">Tidak ada data</td>
        </tr>
    <?php else: ?>
        <?php $no=1; foreach($laporan as $l): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $l['nama'] ?></td>
            <td><?= $l['judul'] ?></td>
            <td><?= date('d-m-Y', strtotime($l['tanggal_pinjam'])) ?></td>
            <td><?= $l['status'] ?></td>
            <td>Rp <?= number_format($l['denda'],0,',','.') ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>
</div>
</div>

</div>