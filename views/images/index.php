<div class="container">

    <div class="page-header">
        <h1>Images</h1>
    </div>

    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-sm-3">
                <div class="thumbnail">
                    <img src="<?= $image->path ?>" class="img-responsive" alt="">
                    <div class="caption">
                        <p>Date: <?= $image->created_at ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>