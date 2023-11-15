<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>
<section class="container-fluid d-flex flex-column align-items-center justify-content-center min-vh-100">
    <main class="card p-4 col-md-6 col-lg-4 col-12">
        <h1 class="h4">Faça seu login</h1>
        <hr class="mb-4">
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="exemplo@email.com">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="••••••••••">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary text-right">Entrar</button>
            </div>
        </form>
    </main>
</section>
<?= $this->endSection('content') ?>