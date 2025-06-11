<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Akses Dilarang</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 80px;
            background-color: #fef2f2;
            color: #b91c1c;
        }
        h1 {
            font-size: 5rem;
        }
        p {
            font-size: 1.2rem;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
            color: #2563eb;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <p>Oops! Kamu tidak memiliki akses ke halaman ini.</p>
    <a href="<?= base_url('/') ?>">⬅️ Kembali ke Beranda</a>
</body>
</html>
