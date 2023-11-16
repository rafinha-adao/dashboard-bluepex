<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('dashboard_content') ?>

<form action="<?= isset($id) ? '/users/' . $id : '/users' ?>" method="post" autocomplete="off">

    <?= csrf_field() ?>

    <?php if (isset($id)) : ?>
        <input type="hidden" _method="put">
    <?php endif; ?>

    <div class="row mb-3">
        <div class="col-sm-6">
            <label for="inputName" class="form-label">Insira um nome</label>
            <input type="text" name="name" class="form-control" id="inputName" placeholder="Ex: Rafael de Oliveira" value="<?= isset($user['name']) ? $user['name'] : null ?>">
            <?php if (session()->get('errors') && isset(session('errors')['name'])) : ?>
                <p class="text-danger">
                    <?= session('errors')['name'] ?>
                </p>
            <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <label for="inputEmail" class="form-label">Insira um e-mail</label>
            <input type="text" name="email" class="form-control" id="inputEmail" placeholder="exemplo@email.com" value="<?= isset($user['email']) ? $user['email'] : null ?>">
            <?php if (session()->get('errors') && isset(session('errors')['email'])) : ?>
                <p class="text-danger">
                    <?= session('errors')['email'] ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <label for="inputPassword" class="form-label">
                Insira uma
                <?= isset($id) ? " nova senha" : " senha" ?>
            </label>
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="••••••••••">
            <?php if (session()->get('errors') && isset(session('errors')['password'])) : ?>
                <p class="text-danger">
                    <?= session('errors')['password'] ?>
                </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-end d-flex gap-2 justify-content-end">
        <a href="/users" class="btn btn-light">Voltar</a>
        <button type="submit" class="btn btn-dark">Salvar</button>
    </div>
</form>

<?= $this->endSection('dashboard_content') ?>