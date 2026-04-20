<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background: #0d6efd;
            color: white;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            padding: 4px 6px;
            border-radius: 4px;
            color: white;
        }

        .dipinjam { background: orange; }
        .kembali { background: green; }
        .telat { background: red; }
    </style>
</head>
<body>

<h2>LAPORAN TRANSAKSI PERPUSTAKAAN</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        <?php if(empty($transaksi)): ?>
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
        <?php else: ?>
            <?php $no=1; foreach($transaksi as $t): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $t['nama'] ?></td>
                <td><?= $t['judul'] ?></td>
                <td><?= date('d-m-Y', strtotime($t['tanggal_pinjam'])) ?></td>
                <td><?= date('d-m-Y', strtotime($t['tanggal_kembali'])) ?></td>
                <td class="text-center">
                    <?php if($t['status'] == 'dipinjam'): ?>
                        <?php if(strtotime($t['tanggal_kembali']) < time()): ?>
                            <span class="badge telat">Terlambat</span>
                        <?php else: ?>
                            <span class="badge dipinjam">Dipinjam</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="badge kembali">Kembali</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>