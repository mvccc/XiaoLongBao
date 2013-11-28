<div class="row well well-half">
  <br>
  <?php
    foreach ($fellowships as $key => $fellowship) 
    {
        $fellowshipUrl = site_url() . '/pages/fellowship/' . $key;
        printf('<div class="col-lg-3">');
        printf('<div class="panel panel-default mvccc-panel">');
        printf('<div class="panel-heading mvccc-panel-heading">');
        printf('<a href="%s">',$fellowshipUrl);
        printf('<h3 class="panel-title">%s</h3>', $fellowship);
        printf('</a>');
        printf('</div>');
        printf('<div class="panel-body mvccc-panel-body">');
        printf('<a href="%s">',$fellowshipUrl);
        printf('Short Description Here or Photo/Icon/Banner.');
        printf('</a>');
        printf('</div>');
        printf('</div></div>');
    }
  ?>
</div>