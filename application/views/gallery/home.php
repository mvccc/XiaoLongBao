<div class="row well">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>照片集錦</h1>
        </div>

        <div class="col-lg-12">
            <a href="<?php echo site_url().'/gallery/createAlbum/' ?>" class="btn btn-primary" role="button">创建相册</a>
        </div>
        <hr class="mvccc-hr"/>

        <?php
            
            print("<br>");
            foreach ($albums as $key => $album)
            {
                $data_src = "";
                $coverImg = "";

                if ( ! is_null($album['cover_img_name']))
                {
                    $img_path = "gallery/" . $album['name'] . '/' . $album['cover_img_name'];
                    $coverImg = base_url() . $img_path;
                
                    # Display a dump image while the image file doesn't exist.
                    if ( ! file_exists($img_path))
                    {
                        $data_src = "holder.js/250x250/auto/gray:#ffffff/text:Missing Photo";
                    }
                }
                else
                {
                    # Display a dump image while the cover image doesn't set.
                    $data_src = "holder.js/250x250/auto/gray:#ffffff/text:Missing Photo";
                }
                
                $albumUrl = site_url() . '/gallery/album/' . $album['id'];
                printf('<div class="col-lg-3">');
                printf('<a href="%s">', $albumUrl);
                printf('<img class="img-thumbnail" src="%s" data-src="%s" />', $coverImg, $data_src);
                printf('</a>');
                printf('<b>%s</b>', $album['title']);
                printf('</div>');
            }
            
        ?>
    </div>
</div>