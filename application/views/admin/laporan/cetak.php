<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan</title>
    <style>
        body { font-family: Arial; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid #000; padding:8px; }
        th { background:#eee; }
        h2 { text-align:center; }
    </style>
</head>

<body onload="window.print()">

<h2>LAPORAN TRANSAKSI</h2>

<p>
Tanggal: <?= $tanggal_awal ?> s/d <?= $tanggal_akhir ?>
</p>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Buku</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Denda</th>
</tr>

<?php $no=1; foreach($laporan as $l): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $l['nama'] ?></td>
    <td><?= $l['judul'] ?></td>
    <td><?= date('d-m-Y', strtotime($l['tanggal_pinjam'])) ?></td>
    <td><?= $l['status'] ?></td>
    <td><?= $l['denda'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>