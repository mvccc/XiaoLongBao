<div class="row well">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>照片集錦</h1>
        </div>

        <?php
            
            print("<br>");
            foreach ($albums as $key => $album)
            { 
                $coverImg = base_url() . 'gallery/' . $album['name'] . '/' . $album['cover_img_name'];
                $albumUrl = site_url() . '/pages/album/' . $album['id'];
                printf('<div class="col-lg-3">');
                printf('<a href="%s">', $albumUrl);
                printf('<img class="img-thumbnail" src="%s"/>', $coverImg);
                printf('</a>');
                printf('<b>%s</b>', $album['title']);
                printf('</div>');
            }
            
        ?>
    </div>
</div>