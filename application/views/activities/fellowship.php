  <div class="row">
    <div class="col-lg-3">
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
    <div class="col-lg-9">
      <h2><?php echo $name ?></h2>
      <hr>
    </div>
  </div>