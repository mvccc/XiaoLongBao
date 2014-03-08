        <hr>
      	<footer>
        	<p>&copy; MVCCC 2013</p>
     	</footer>

    </div><!--/.container-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mvccc.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/holder.js"></script>

    <?php
        if (isset($js_plugins))
        {
            echo $js_plugins;
        }
    ?>

  </body>
</html>