<?= $this->extend('Admin/layout/main') ?>

<?= $this->section('title') ?> Crear Articulo <?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title has-text-centered">Crea un Articulo</h1>

<form action="<?= base_url(route_to('posts_store')) ?>" enctype="multipart/form-data" method="POST">
    <div class="columns">

        <div class="column is-four-fifths">
            <div class="field">
                <label class="label">Titulo</label>
                <div class="control">
                    <input class="input" type="text" name="title" placeholder="" value="<?=old('title')?>">
                </div>
                <p class="help is-danger"><?=session('errors.title') ?></p>
            </div>
            <div class="field">
                <label class="label"> Cuerpo </label>
                <div class="control">
                    <textarea class="textarea" id="body" name="body"> <?=old('body')?> </textarea>
                </div>
                <p class="help is-danger"><?=session('errors.body') ?></p>
            </div>
        </div>
    

        <div class="column">
            <div class="field">
                <div class="file has-name is-boxed">
                    <label class="file-label">
                        <input class="file-input" type="file" name="cover">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file...
                            </span>
                        </span>
                        <span class="file-name">
                            Screen Shot 2017-07-29 at 15.54.25.png
                        </span>
                    </label>
                </div>
                <p class="help is-danger"><?=session('errors.cover') ?></p>
            </div>

            <div class="field">
                <label class="label">Fecha de Publicaion</label>
                <div class="control">
                    <input class="input" type="date" name="published_at" value="<?=old('published_at')?>">
                </div>
                <p class="help is-danger"><?=session('errors.published_at') ?></p>
            </div>

            <div class="field">
                <label class="label">Categorias</label>
                <?php if(empty($categories)):?>
                    <a href="<?= base_url(route_to('categories_create')) ?>">Agregar una categoria</a>
                <?php else: ?>
                    <?php foreach($categories as $key): ?>
                        <div class="field">
                            <label class="checkbox">
                                <input type="checkbox" name="categories[]" value="<?= $key->id ?>"
                                <?= old('categories.*') ? (in_array($key->id, old('categories.*')) ? 'checked' : '') : ''?> > 
                                <?= $key->name ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <p class="help is-danger"> <?= session('errors')['categories.*'] ?? '' ?> </p>
                <?php endif; ?>

                
            </div>
        </div>

    </div>

    <div class="field">
        <button type="submit" class="button is-fullwidth is-dark">Guardar</button>
    </div>

</form>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.3/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#body',
        height: 500,
        menubar: false,
        plugins: [
            'advList autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount code'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help | code ',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
<?= $this->endSection() ?>