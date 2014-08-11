<div class="container">
    <div class="row well">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url().'/gallery/home'?>">照片集錦</a></li>
                <li class="active"><a href="#"><?php echo $album['title'] ?></a></li>
            </ol>
            <div class="page-header">
                <h1><?php echo $album['title'];?></h1>
            </div>

            <?php # Only display the buttons when the loggin user has the update album privilege. ?>
            <?php if (Access::hasPrivilege(Access::PRI_UPDATE_ALBUM)) : ?>
                <div class="col-lg-12">
                    <a href="<?php echo site_url().'/gallery/update_album/' . $album['id']?>" class="btn btn-primary" role="button">更改照片</a>
                    <a href="<?php echo site_url().'/gallery/update_album_info/' . $album['id']?>" class="btn btn-warning" role="button">更改信息</a>
                    <a href="#" class="btn btn-danger" role="button">删除相册</a>
                </div>
                <hr class="mvccc-hr"/>
            <?php endif; ?>

            <br>
            <div id="container">
            <?php foreach ($img_pathes as $key => $img_path) : ?>
                <?php # Display each image file. ?>
                <div class="gallery-item">
                    <a class="fancybox" rel="group" href="<?php echo $img_path;?>">
                        <img class="img-thumbnail" src="<?php echo $img_path;?>" alt="" />
                    </a>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>