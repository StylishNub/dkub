<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#2e2252] via-[#3f2d68] to-[#2e2252] min-h-screen flex items-center justify-center font-sans">
    <div class="bg-[#ffffff0f] backdrop-blur-xl w-full max-w-sm p-8 rounded-2xl shadow-xl animate-fadeIn border border-[#ffffff1a]">
        <!-- Logo -->
        <div class="flex justify-center mb-4">
            <a href="/"><img src="<?= base_url('/img/logo_dk.png') ?>" alt="Logo" class="h-[70px]" /></a>
        </div>

        <!-- Title -->
        <h2 class="text-center text-white text-2xl font-semibold mb-6 tracking-wide">Welcome Back</h2>
        <?php if (session()->getFlashdata('error')) : ?>
            <div id="popupError" class="bg-red-500 text-white px-4 py-2 rounded mb-4 text-center animate-fadeIn">
                <?= session()->getFlashdata('error') ?>
            </div>
            <script>
                setTimeout(() => {
                    const popup = document.getElementById('popupError');
                    if (popup) popup.remove();
                }, 3000);
            </script>
        <?php endif; ?>

        <!-- Form -->
        <form action="/auth/cek_login" method="POST" class="space-y-5">
            <input 
                type="email" 
                name="email" 
                placeholder="Email"
                required
                class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-800 placeholder-gray-500 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200"
            >
            <input 
                type="password" 
                name="password" 
                placeholder="Password"
                required
                class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-800 placeholder-gray-500 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-200"
            >
            <button 
                type="submit"
                class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300"
            >
                Login
            </button>
        </form>
    </div>

    <!-- <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out;
        }
    </style> -->

</body>

</html>
