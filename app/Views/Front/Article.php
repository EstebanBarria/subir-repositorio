<?= $this->extend('Front/layout/main') ?>

<?= $this->section('title') ?> <?= $post->title ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="section">
        <div class="content">
            <img src="<?= $post->getLink() ?>" style="width:100%;height:300px;object-fit:cover;" alt="">
            <h1><?= $post->title ?></h1>
            <h3><?= $post->author->getFullName() ?></h3>
            <p><?= $post->published_at->humanize() ?></p>

            <div class="tags are-medium">
                <?php foreach($post->getCategories() as $key): ?>
                <span class="tag">#<?= $key->name ?></span>
                <?php endforeach; ?>
            </div>
            <p> <?= $post->body ?> </p>
        </div>
    </section>

<?= $this->endSection() ?>