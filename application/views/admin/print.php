<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <style>
        body { font-family: Arial; }
        h2 { text-align: center; }
        table { width:100%; border-collapse: collapse; }
        th, td { border:1px solid black; padding:8px; }
    </style>
</head>
<body onload="window.print()">

<h2>Laporan Peminjaman Buku</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Buku</th>
        <th>Tanggal</th>
        <th>Kembali</th>
        <th>Status</th>
    </tr>

    <?php $no=1; foreach($laporan as $l): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $l['nama'] ?></td>
        <td><?= $l['judul'] ?></td>
        <td><?= $l['tanggal_pinjam'] ?></td>
        <td><?= $l['tanggal_kembali'] ?></td>
        <td><?= $l['status'] ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>