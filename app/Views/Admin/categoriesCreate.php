<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('title') ?> Agregar una Categoria <?= $this->endSection() ?>

<?= $this->section('content') ?>

    <form action="<?= base_url(route_to('categories_store')) ?>" method="POST">
        <div class="field">
            <label class="label">Nombre Categoria</label>
            <div class="control">
                <input class="input" value="<?= old('name') ?>" name="name" type="text">
            </div>
            <p class="help is-danger">
            <?= session('errors.name') ?>
            </p>
        </div>
        <div class="field">
            <div class="control">
                <input type="submit" class="button is-dark" value="Guardar">
            </div>
        </div>
    </form>

<?= $this->endSection() ?>
