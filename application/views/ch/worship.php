<div class="row">
	<div class="col-lg-12 well">
		<div class="page-header">
			<h2>主日信息 
				<?php
					$logged_in = $this->session->userdata('logged_in');
					$url = site_url() . '/pages/add_sunday_message';
					if(isset($logged_in) && $logged_in === TRUE)
					{
						printf('<a href="%s" class="btn btn-info btn-lg pull-right" role="button">添加信息</a>', $url);
					}
				?>
			</h2>
		</div>
		<ul class="pagination">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
		<table class="table table-striped table-hover">
			<thead><th>時間</th><th>信息</th><th>講員</th><th>錄音</th><th>錄像</th><th>經文</th></thead>
			<tbody>
			<?php
				foreach ($messages as $key => $message) 
				{
					printf("<tr>");
					printf("<td>%s</td>", $message['date']);
					printf("<td>%s</td>", $message['messageName']);
					printf("<td>%s</td>", $message['paster']);
					printf("<td><span class=\"glyphicon glyphicon-volume-up\"></span></td>");
					printf("<td><span class=\"glyphicon glyphicon-facetime-video\"></span></td>");
					printf("<td>");
					printf("<span class=\"glyphicon glyphicon-list\"></span>");
					printf("</button>");
					printf("</td>");
					printf("</tr>");
				}
			?>
			</tbody>
		</table>
		<ul class="pagination">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
	</div>
</div>