<?php $this->extend('layout/templateUserLogin'); ?>

<?php $this->section('content'); ?>

<div>
    <h1 class="font-gowun-batang text-16">
        Selamat datang, <span class="font-semibold"><?= esc($user['name']); ?></span> !<br>
        dari <span class="font-semibold text-14"><?= esc($user['instansi']); ?></span>
    </h1>
</div>
<?php $this->endSection(); ?>
