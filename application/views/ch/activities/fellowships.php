<div class="row well half">
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

  <!--
    <div class="col-lg-3">
      <br><br><br>
   	  <div class="side-menu">
   	  	<ul>
   	  	<?php
   	  		foreach ($fellowships as $key => $value) 
   	  		{
   	  			$path = base_url().'index.php/pages/fellowship/'.$key;
   	  			printf("<li><a href=\"%s\">%s</a></li>", $path, $value);
   	  		}
   	  	?>
   	  	</ul>
	  </div>
    </div>
    <div class="col-lg-9 well">
      <h2><?php echo $name ?></h2>
      <hr>
      description<br>
      description<br>
      description<br>
      time<br>
      location<br>
      <img data-src="holder.js/100%x400/auto/#777:#ffffff/text:Fellowship Photo" alt="Fellowship Photo">
    </div>
  -->
</div>