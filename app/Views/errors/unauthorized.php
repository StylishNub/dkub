<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Tidak Ditemukan</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f9fafb;
            color: #333;
            text-align: center;
            padding: 80px;
        }
        h1 {
            font-size: 5rem;
            color: #ef4444;
        }
        p {
            font-size: 1.2rem;
        }
        a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
        <h1>401</h1>
        <h3>Akses Ditolak</h3>
        <p>Kamu harus login terlebih dahulu!</p>
        <a href="<?= base_url('/login') ?>">Login di sini</a>
</body>
</html>
