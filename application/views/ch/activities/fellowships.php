<div class="row well well-half">
    <div class="page-header">   
        <h1>團契生活</h1>
    </div>
  <br>
  <?php
    foreach ($fellowships as $key => $fellowship) 
    {
        $fellowshipUrl = site_url() . '/pages/fellowship/' . $key;
        printf('<div class="col-lg-3">');
        printf('<div class="panel panel-default mvccc-panel">');
        printf('<div class="panel-heading mvccc-panel-heading">');
        printf('<a href="%s">',$fellowshipUrl);
        printf('<h3 class="panel-title">%s</h3>', $fellowship['name']);
        printf('</a>');
        printf('</div>');
        printf('<div class="panel-body mvccc-panel-body">');
        printf('<a href="%s">',$fellowshipUrl);

        printf('<b>地點:</b> %s<br>', $fellowship['location']);
        printf('<b>時間:</b> %s<br>', $fellowship['time']);
        printf('<b>聯系人:</b> %s<br>', $fellowship['contact']);
        printf('<b>電話:</b> %s<br>', $fellowship['tel']);

        printf('</a>');
        printf('</div>');
        printf('</div></div>');
    }
  ?>
</div>