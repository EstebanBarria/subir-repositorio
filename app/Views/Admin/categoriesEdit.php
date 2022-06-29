<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('title') ?> Editar Categoria : <?= $category->name ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= base_url(route_to('categories_update')) ?>" method="POST">
        <div class="field">
            <label class="label">Nombre Categoria</label>
            <div class="control">
                <input class="input" value="<?= old('name') ?? $category->name ?>" name="name" type="text">
                <input class="input" value="<?= old('id') ?? $category->id ?>" name="id" type="hidden">
            </div>
            <p class="help is-danger">
            <?= session('errors.name') ?>
            </p>
        </div>
        <div class="field">
            <div class="control">
                <input type="submit" class="button is-dark" value="Actualizar">
            </div>
        </div>
    </form>

<?= $this->endSection() ?>
