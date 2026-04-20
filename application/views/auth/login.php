<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login - Perpustakaan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* ================= BACKGROUND ================= */
body {
    height: 100vh;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;

    background: linear-gradient(135deg, #0d6efd, #3a86ff, #6ea8fe);
    background-size: 300% 300%;
    animation: gradientMove 8s ease infinite;

    display: flex;
    justify-content: center;
    align-items: center;
}

/* Animasi gradient */
@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* ================= CARD ================= */
.login-card {
    width: 360px;
    padding: 30px;
    border-radius: 20px;

    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(20px);

    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    color: white;
    text-align: center;
}

/* ICON */
.logo {
    font-size: 45px;
    margin-bottom: 10px;
}

/* TITLE */
.login-card h3 {
    font-weight: bold;
}

/* INPUT */
.form-control {
    border-radius: 12px;
    border: none;
    padding: 12px;

    background: rgba(255,255,255,0.2);
    color: white;
}

.form-control::placeholder {
    color: #e0e0e0;
}

.form-control:focus {
    background: rgba(255,255,255,0.3);
    box-shadow: none;
    color: white;
}

/* BUTTON */
.btn-login {
    background: white;
    color: #0d6efd;
    border-radius: 12px;
    padding: 10px;
    font-weight: bold;
    transition: 0.3s;
}

.btn-login:hover {
    background: #e6f0ff;
}

/* LINK */
a {
    color: #fff;
    text-decoration: underline;
}

a:hover {
    color: #dbeafe;
}
</style>
</head>

<body>

<div class="login-card">

    <div class="logo">
        <i class="bi bi-book"></i>
    </div>

    <h3>Perpustakaan Digital</h3>
    <p class="mb-4">Silakan login untuk melanjutkan</p>

    <!-- ALERT -->
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger py-2">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('auth/login') ?>">

        <div class="mb-3 text-start">
            <label>Username / NIS</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-login w-100 mb-3">
            <i class="bi bi-box-arrow-in-right"></i> Masuk
        </button>

    </form>

    <small>Belum punya akun? <a href="#">Daftar</a></small>

</div>

</body>
</html>