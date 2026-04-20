<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Perpustakaan Digital</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-soft: #eef2ff;
            --dark: #1e293b;
            --text: #64748b;
            --bg: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg); /* 🔥 GANTI dari gradient ke clean */
        }

        /* WRAPPER */
        .wrapper {
            display: flex;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
        }

        /* CARD */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        /* CARD HEADER */
        .card-header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            padding: 18px 25px;
            font-weight: 600;
        }

        /* BUTTON */
        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99,102,241,0.4);
        }

        .btn-outline-primary {
            border-radius: 12px;
            border: 2px solid #6366f1;
            color: #6366f1;
        }

        .btn-outline-primary:hover {
            background: #6366f1;
            color: white;
        }

        /* TABLE */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: #eef2ff;
        }

        .table th {
            color: #334155;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background: #f8fafc;
        }

        /* FORM */
        .form-control {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
        }

        /* BADGE */
        .badge {
            border-radius: 999px;
            padding: 6px 12px;
            font-weight: 500;
        }

        /* HEADER TEXT */
        .page-header h2 {
            font-weight: 700;
            color: var(--dark);
        }

        .page-header p {
            color: var(--text);
        }

        /* STAT CARD */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .icon {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: var(--primary-soft);
            color: #6366f1;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
        }

        .stat-card .label {
            font-size: 0.85rem;
            color: var(--text);
        }

        /* ALERT */
        .alert {
            border-radius: 12px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>