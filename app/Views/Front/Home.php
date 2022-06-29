<?= $this->extend('Front/layout/main') ?>

<?= $this->section('title') ?> Home <?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">

        <div class="columns is-multiline">
            <?php foreach($posts as $key): ?>
            <div class="column is-one-quarter">
                <a href="<?= $key->getLinkArticle() ?>">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="<?= $key->getLink() ?>" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="media">
                                <div class="media-left">
                                    <figure class="image is-48x48">
                                        <img src="https://bulma.io/images/placeholders/96x96.png" alt="Placeholder image">
                                    </figure>
                                </div>
                                    <div class="media-content">
                                        <p class="title is-4"><?= $key->title ?></p>
                                        <p class="subtitle is-6"><?= $key->author->getFullName() ?></p>
                                    </div>
                            </div>

                            <div class="content">

                                <?= character_limiter(strip_tags($key->body),10 ) ?>

                                <br>
                                <?php if(!empty($key->getCategories())): ?>

                                    <?php foreach($key->getCategories() as $v): ?>

                                        <a href="#"><?= $v->name ?></a>

                                    <?php endforeach; ?> 

                                <?php endif; ?>

                                <br>
                                <time datetime="2016-1-1"><?= $key->published_at->humanize() ?></time>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?= $pager->links() ?>
</section>
<section class="section">
<h1>Articulos de php</h1>
<?= view_cell('\App\Controllers\Front\Home::filter', ['category' => 'phyton', 'limit' => 4]) ?>                                    
</section>
<?= $this->endSection() ?>
