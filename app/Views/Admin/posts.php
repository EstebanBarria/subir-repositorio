<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('title') ?> Lista Articulos <?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Listado de articulos</h1>
<a href="<?= base_url(route_to('posts_create')) ?>">Alta Articulos</a>
<?= $this->endSection() ?>
