<div class="container">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>照片集錦</h1>
        </div>

        <?php # Only display the *Create Album* button when the loggin user has the update album privilege.?>
        <?php if (Access::hasPrivilege(Access::PRI_UPDATE_ALBUM)) : ?>
            <div class="col-lg-12">
                <a href="<?php echo site_url().'/gallery/create_album/' ?>" class="btn btn-primary" role="button">创建相册</a>
            </div>
            <hr class="mvccc-hr"/>
        <?php endif; ?>

        <br>
        <?php foreach ($albums as $key => $album) : ?>
            <?php # Display each album. ?>
            <div class="col-lg-3">
                <a href="<?php echo $album['albumUrl'] ?>">
                    <img class="img-thumbnail" src="<?php echo $album['coverImg'] ?>" data-src="<?php echo $album['dataSrc'] ?>" />
                </a>
                <b><?php echo $album['title'] ?></b>
            </div>
        <?php endforeach; ?>
    </div>
</div>