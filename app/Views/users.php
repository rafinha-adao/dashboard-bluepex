<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('action_button') ?>

<a href="/users/add" class="btn btn-dark">Adicionar novo</a>

<?= $this->endSection('action_button') ?>

<?= $this->section('dashboard_content') ?>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($users as $user) : ?>

                <tr>
                    <th scope="row"><?= $user['id'] ?></th>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td class="d-flex gap-1">
                        <a href="/users/<?= $user['id'] ?>/edit" type="button" class="btn btn-secondary btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="/users/<?= $user['id'] ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" onclick="return confirm('Deseja mesmo excluir esse usuário?')" type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?= $this->endSection('dashboard_content') ?>