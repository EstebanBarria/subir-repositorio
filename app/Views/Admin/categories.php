<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('title') ?> Lista de Categorias <?= $this->endSection() ?>

<?= $this->section('content') ?>

    <div class="field">
        <a class="button is-dark" href="<?= base_url(route_to('categories_create')) ?>"> Agregar Nueva Categoria </a>
    </div>
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Creado</th>
            <th>Actualizado</th>
            <th>Acciones</th>
        </tr>
    </thead>
        <tbody>
            <?php foreach ($categories as $key):?>
                <tr>
                    <th><?= $key->id ?></th>
                    <th><?= $key->name ?></th>
                    <th><?= $key->created_at->humanize() ?></th>
                    <th><?= $key->updated_at->humanize() ?></th>
                    <th><a href="<?= $key->getEditLink() ?>">Editar</a> | <a href="<?= $key->getDeleteLink() ?> ">Eliminar</a></th>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?= $pager->links() ?>



<?= $this->endSection() ?>
