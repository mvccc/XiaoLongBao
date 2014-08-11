<div class="container">
    <div class="row well">
        <div class="col-lg-12">
            <div class="page-header">
                <h1>AWANA</h1>
            </div>

            <?php
                # Load Awana Menu.
                $data['lang'] = $lang;
                $this->load->view('/awana/awana_menu', $data);

                print("<br>");
                printf('<div id="container">');
                // Absolute path to the AWANA Album.
                $albumDir = FCPATH . 'gallery/awana/';

                $files = scandir($albumDir);
                foreach ($files as $key => $value)
                {
                    if ($key > 1)
                    {
                        $imgPath = base_url() . 'gallery/awana/' . $value;
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
</div>