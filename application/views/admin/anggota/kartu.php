<!DOCTYPE html>
<html>
<head>
    <title>Kartu Anggota</title>

    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
        }

        .card {
            width: 350px;
            height: 220px;
            background: linear-gradient(135deg, #0d6efd, #00c6ff);
            border-radius: 15px;
            color: white;
            padding: 15px;
            margin: 50px auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            position: relative;
        }

        .header {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .foto {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            display: block;
            margin: auto;
        }

        .nama {
            text-align: center;
            font-weight: bold;
            margin-top: 8px;
        }

        .nis {
            text-align: center;
            font-size: 12px;
        }

        .detail {
            font-size: 12px;
            margin-top: 10px;
        }

        .footer {
            position: absolute;
            bottom: 10px;
            right: 15px;
            font-size: 10px;
        }

        @media print {
            body {
                background: none;
            }
        }
    </style>

</head>

<body onload="window.print()">

<div class="card">

    <div class="header">
        KARTU ANGGOTA PERPUSTAKAAN
    </div>

    <!-- FOTO -->
    <?php if (!empty($anggota['foto'])): ?>
        <img src="<?= base_url('uploads/anggota/'.$anggota['foto']) ?>" class="foto">
    <?php else: ?>
        <div style="
            width:70px;
            height:70px;
            background:white;
            color:#0d6efd;
            border-radius:50%;
            text-align:center;
            line-height:70px;
            font-size:30px;
            margin:auto;
        ">
            <?= strtoupper(substr($anggota['nama'],0,1)) ?>
        </div>
    <?php endif; ?>

    <div class="nama"><?= strtoupper($anggota['nama']) ?></div>
    <div class="nis">NIS: <?= $anggota['nis'] ?></div>

    <div class="detail">
        <p>Kelas: <?= $anggota['kelas'] ?></p>
        <p>Telp: <?= $anggota['telepon'] ?: '-' ?></p>
    </div>

    <div class="footer">
        Perpustakaan Digital
    </div>

</div>

</body>
</html>