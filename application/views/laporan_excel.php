<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_transaksi.xls");
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($transaksi as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['judul'] ?></td>
            <td><?= $row['tanggal_pinjam'] ?></td>
            <td><?= $row['tanggal_kembali'] ?? '-' ?></td>
            <td><?= $row['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>