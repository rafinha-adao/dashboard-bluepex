<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<section class="container-fluid d-flex flex-column align-items-center justify-content-center" style="min-height: 100svh">
    <main class="card p-4 col-md-6 col-lg-4 col-12">

        <?php if (session()->has('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <h1 class="h4">Faça seu login</h1>

        <hr class="mb-4">
        <form action="/login" method="POST">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="text" name="email" class="form-control" id="inputEmail" placeholder="exemplo@email.com">
                <?php if (session()->get('errors') && isset(session('errors')['email'])) : ?>
                    <p class="text-danger">
                        <?= session('errors')['email'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="••••••••••">
                <?php if (session()->get('errors') && isset(session('errors')['password'])) : ?>
                    <p class="text-danger">
                        <?= session('errors')['password'] ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-dark text-right">Entrar</button>
            </div>
        </form>
    </main>
</section>

<?= $this->endSection('content') ?>