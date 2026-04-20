<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Perpustakaan Digital</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #4facfe);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-card {
            width: 100%;
            max-width: 520px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }

        .form-control {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #0d6efd, #4facfe);
            border: none;
            padding: 12px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-register:hover {
            transform: scale(1.03);
            opacity: 0.9;
        }

        .title-icon {
            font-size: 40px;
            color: #0d6efd;
        }
    </style>
</head>

<body>

<div class="register-card">

    <div class="text-center mb-3">
        <i class="bi bi-person-plus-fill title-icon"></i>
        <h3 class="mt-2">Registrasi</h3>
        <small class="text-muted">Perpustakaan Digital</small>
    </div>

    <!-- ERROR VALIDATION -->
    <?= validation_errors('<div class="alert alert-danger">','</div>'); ?>

    <!-- ERROR SESSION -->
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- SUCCESS -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/register') ?>" method="post">

        <div class="row">
            <div class="col-md-6 mb-2">
                <input type="text" name="nis" class="form-control"
                       placeholder="NIS"
                       value="<?= set_value('nis') ?>" required>
            </div>

            <div class="col-md-6 mb-2">
                <input type="text" name="kelas" class="form-control"
                       placeholder="Kelas"
                       value="<?= set_value('kelas') ?>" required>
            </div>
        </div>

        <div class="mb-2">
            <input type="text" name="nama" class="form-control"
                   placeholder="Nama Lengkap"
                   value="<?= set_value('nama') ?>" required>
        </div>

        <div class="mb-2">
            <input type="text" name="alamat" class="form-control"
                   placeholder="Alamat"
                   value="<?= set_value('alamat') ?>">
        </div>

        <div class="mb-2">
            <input type="text" name="telepon" class="form-control"
                   placeholder="No. Telepon"
                   value="<?= set_value('telepon') ?>">
        </div>

        <!-- PASSWORD -->
        <div class="mb-2 position-relative">
            <input type="password" name="password" id="password" class="form-control"
                   placeholder="Password" required>

            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
               style="cursor:pointer"
               onclick="togglePassword('password', this)"></i>
        </div>

        <div class="mb-3 position-relative">
            <input type="password" name="password_confirm" id="password2" class="form-control"
                   placeholder="Konfirmasi Password" required>

            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3"
               style="cursor:pointer"
               onclick="togglePassword('password2', this)"></i>
        </div>

        <button class="btn-register">
            <i class="bi bi-check-circle"></i> Daftar
        </button>

    </form>

    <div class="text-center mt-3">
        Sudah punya akun? 
        <a href="<?= base_url('auth') ?>">Login</a>
    </div>

</div>

<!-- SCRIPT -->
<script>
function togglePassword(id, el) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        el.classList.remove('bi-eye-slash');
        el.classList.add('bi-eye');
    } else {
        input.type = "password";
        el.classList.remove('bi-eye');
        el.classList.add('bi-eye-slash');
    }
}
</script>

</body>
</html>