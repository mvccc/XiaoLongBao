<div class="row well">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url().'/gallery/home'?>">照片集錦</a></li>
            <li class="active"><a href="#"><?php echo $album['title'] ?></a></li>
        </ol>
        <div class="page-header">
            <h1><?php echo $album['title'];?></h1>
        </div>

        <div class="col-lg-12">
            <a href="<?php echo site_url().'/gallery/updateAlbum/' . $album['id']?>" class="btn btn-primary" role="button">更改相册</a>
            <a href="#" class="btn btn-danger" role="button">删除相册</a>
        </div>

        <hr class="mvccc-hr"/>

        <?php

            print("<br>");
            printf('<div id="container">');
            // Absolute path to the AWANA Album.
            $albumDir = FCPATH . 'gallery/' . $album['name'];

            if (file_exists($albumDir) && is_dir($albumDir))
            {
                $files = scandir($albumDir);
                foreach ($files as $key => $value)
                {
                    if ($key > 1)
                    {
                        $imgPath = base_url() . 'gallery/' . $album['name'] . '/' . $value;
                        printf('<div class="gallery-item">');
                        printf('<a class="fancybox" rel="group" href="%s">', $imgPath);
                        printf('<img class="img-thumbnail" src="%s" alt="" />', $imgPath);
                        printf('</a>');
                        printf('</div>');
                    }
                }
            }
            printf("</div>");

            clearstatcache();
        ?>
    </div>
</div>