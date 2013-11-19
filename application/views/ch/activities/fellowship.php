  <div class="row">
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
  </div>