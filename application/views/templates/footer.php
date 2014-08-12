    <div class="container">    
        <hr>
      	<footer>
        	<p>&copy; MVCCC 2013</p>
     	</footer>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mvccc.js"></script>

    <?php
        if (isset($js_plugins))
        {
            echo $js_plugins;
        }
    ?>

  </body>
</html>