<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height: 60px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Bluepex Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navToggle" aria-controls="navToggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navToggle">
            <ul class="navbar-nav me-auto mb-2 gap-1 mt-3 mb-lg-0 d-block d-lg-none">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="bi bi-house-door me-1"></i>
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/users">
                        <i class="bi bi-people me-1"></i>
                        Usuários
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="return confirm('Deseja mesmo sair?')" href="/logout">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Sair
                    </a>
                </li>
            </ul>
        </div>
        <a class="nav-link text-light d-lg-block d-none" onclick="return confirm('Deseja mesmo sair?')" href="/logout">
            <i class="bi bi-box-arrow-in-right me-1"></i>
            Sair
        </a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-lg-2 d-lg-block bg-secondary sidebar d-none" style="min-height: calc(100vh - 60px);">
            <div class="position-sticky">
                <ul class="nav flex-column gap-1 mt-3">
                    <li class="nav-item">
                        <a class="nav-link text-light fs-6" href="/">
                            <i class="bi bi-house-door me-1"></i>
                            Início
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light fs-6" href="/users">
                            <i class="bi bi-people me-1"></i>
                            Usuários
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-lg-10 px-md-4">

            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
                    <?= session('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
                    <?= session('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                <h1 class="h3"><?= $title ?></h1>

                <?= $this->renderSection('action_button') ?>

            </div>

            <?= $this->renderSection('dashboard_content') ?>

        </main>
    </div>
</div>

<?= $this->endSection('content') ?>