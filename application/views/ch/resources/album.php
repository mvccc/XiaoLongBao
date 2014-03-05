<div class="row well">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url().'/pages/gallery'?>">照片集錦</a></li>
            <li class="active"><a href="#"><?php echo $album['title'] ?></a></li>
        </ol>
        <div class="page-header">
            <h1><?php echo $album['title']; ?></h1>
        </div>

        <?php

            print("<br>");
            printf('<div id="container">');
            // Absolute path to the AWANA Album.
            $albumDir = FCPATH . 'gallery/' . $album['name'];

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
            printf("</div>");
        ?>
    </div>
</div>