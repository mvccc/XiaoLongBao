<div class="row well">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>照片集錦</h1>
        </div>

        <?php # Only display the *Create Album* button when the loggin user has the update album privilege.?>
        <?php if (Access::hasPrivilege(Access::PRI_UPDATE_ALBUM)) : ?>
            <div class="col-lg-12">
                <a href="<?php echo site_url().'/gallery/createAlbum/' ?>" class="btn btn-primary" role="button">创建相册</a>
            </div>
            <hr class="mvccc-hr"/>
        <?php endif; ?>

        <br>
        <?php foreach ($albums as $key => $album) :
                $data_src = "";
                $coverImg = "";

                if ( ! is_null($album['cover_img_name'])) :
                    $img_path = "gallery/" . $album['name'] . '/' . $album['cover_img_name'];
                    $coverImg = base_url() . $img_path;
                
                    # Display a dump image while the image file doesn't exist.
                    if ( ! file_exists($img_path)) :
                        $data_src = "holder.js/250x250/auto/gray:#ffffff/text:Missing Photo";
                    endif;
                else :
                    # Display a dump image while the cover image doesn't set.
                    $data_src = "holder.js/250x250/auto/gray:#ffffff/text:Missing Photo";
                endif;
                
                $albumUrl = site_url() . '/gallery/album/' . $album['id'];

                ?>
                <?php # Display each album. ?>
                <div class="col-lg-3">
                    <a href="<?php echo $albumUrl ?>">
                        <img class="img-thumbnail" src="<?php echo $coverImg ?>" data-src="<?php echo $data_src ?>" />
                    </a>
                    <b><?php echo $album['title'] ?></b>
                </div>
        <?php endforeach; ?>
    </div>
</div>