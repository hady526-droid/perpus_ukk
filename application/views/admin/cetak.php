<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kartu Anggota</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
        }

        /* AREA PRINT */
        .print-area {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        /* CARD */
        .card {
            width: 350px;
            height: 200px;
            border-radius: 15px;
            color: #fff;
            padding: 20px;
            position: relative;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);

            background: linear-gradient(135deg, #2196f3, #0d47a1);
        }

        .card h4 {
            margin: 0;
            font-size: 14px;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        .card h2 {
            margin: 10px 0 5px;
        }

        .card small {
            font-size: 12px;
        }

        /* PROFILE BULAT */
        .avatar {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }

        /* FOOTER */
        .footer {
            position: absolute;
            bottom: 15px;
            left: 20px;
            font-size: 11px;
            opacity: 0.8;
        }

        /* BUTTON */
        .btn-print {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background: #2196f3;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }

        /* PRINT MODE */
        @media print {
            body {
                background: white;
            }

            .btn-print {
                display: none;
            }

            .card {
                box-shadow: none;
                margin: auto;
            }
        }
    </style>
</head>

<body>

<div class="print-area">
    <div class="card">

        <h4>KARTU ANGGOTA</h4>

        <div class="avatar">
            <?= strtoupper(substr($anggota['nama'], 0, 1)); ?>
        </div>

        <h2><?= $anggota['nama']; ?></h2>
        <small>NIS: <?= $anggota['nis']; ?></small><br>
        <small>Kelas: <?= $anggota['kelas']; ?></small><br>
        <small>Telp: <?= $anggota['telepon']; ?></small>

        <div class="footer">
            Perpustakaan Digital
        </div>

    </div>
</div>

<button class="btn-print" onclick="window.print()">🖨 Cetak Kartu</button>

</body>
</html>