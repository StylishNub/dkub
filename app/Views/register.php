<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Actor&family=Alegreya:ital,wght@0,400..900;1,400..900&family=Aleo:ital,wght@0,100..900;1,100..900&family=Gowun+Batang&family=Gravitas+One&family=Katibeh&family=Marcellus&family=Purple+Purse&family=Quattrocento:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sree+Krushnadevaraya&display=swap" rel="stylesheet">
    <title>Sign Up</title>
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet" />
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-teal-400 to-blue-600">

  <div class="bg-white w-full max-w-sm p-8 rounded-xl shadow-xl relative">
    
    <!-- Notifikasi -->
    <?php if (session()->getFlashdata('warning')): ?>
    <div class="alert-flash p-4 mb-4 text-yellow-800 bg-yellow-100 rounded-lg">
        <strong class="font-semibold">Perhatian:</strong> <?= session()->getFlashdata('warning') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('pesan')): ?>
  <div class="alert-flash bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
    <?= session()->getFlashdata('pesan') ?>
  </div>
<?php endif; ?>


    <?php if (session()->getFlashdata('errors')): ?>
      <ul class="alert-flash bg-red-100 text-red-600 px-4 py-2 rounded mb-4 text-sm">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>

    

    <!-- Title -->
    <h2 class="text-center text-xl font-semibold text-blue-600 mb-6">• Registration Form •</h2>

    <!-- Form -->
    <form class="space-y-4" action="<?= base_url('/auth/save_register') ?>" method="post">
      <?= csrf_field() ?>

      <input type="text" name="name" placeholder="Nama" class="w-full border-b border-gray-300 focus:outline-none focus:border-blue-500 py-2 placeholder-gray-500" value="<?= old('name') ?>" required>

      <input type="email" name="email" placeholder="Email" class="w-full border-b border-gray-300 focus:outline-none focus:border-blue-500 py-2 placeholder-gray-500" value="<?= old('email') ?>" required
      >
      <input type="instansi" name="instansi" placeholder="Masukkan Nama Instansi" class="w-full border-b border-gray-300 focus:outline-none focus:border-blue-500 py-2 placeholder-gray-500" value="<?= old('instansi') ?>" required>

      <input type="text" name="kepentingan" placeholder="Kepentingan" class="w-full border-b border-gray-300 focus:outline-none focus:border-blue-500 py-2 placeholder-gray-500" value="<?= old('kepentingan') ?>" required>

      <div class="relative">
        <input type="text" disabled placeholder="Password akan dikirim setelah disetujui admin" class="w-full bg-gray-100 border-b border-gray-300 py-2 pr-10 text-gray-500 placeholder-gray-500">
        <span class="absolute right-2 top-2 text-blue-500 cursor-not-allowed">🔒</span>
      </div>

      <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold">
        Kirim Pendaftaran
      </button>

      <p class="text-center text-sm text-gray-600 mt-4">
        Sudah punya akun? <a href="<?= base_url('/login') ?>" class="text-blue-600 hover:underline">Login</a>
      </p>
    </form>
  </div>
  <script>
    // Hilangkan alert setelah 3 detik (3000 ms)
    setTimeout(() => {
        const alertBox = document.querySelectorAll('.alert-flash');
        alertBox.forEach(el => el.classList.add('opacity-0', 'transition-opacity', 'duration-500'));
        setTimeout(() => el.remove(), 500); // Hapus dari DOM setelah fade out
    }, 3000);
</script>

</body>
