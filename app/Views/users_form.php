<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<h1><?= $title ?></h1>

<?php if (isset($id)) : ?>
    <span><?= $id ?></span>
<?php endif; ?>

<?= $this->endSection('content') ?>