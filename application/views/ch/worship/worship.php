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
		<!--ul class="pagination">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul-->
		<table class="table table-striped table-hover">
			<thead><th>時間</th><th>信息</th><th>講員</th><th>下載</th><th>收聽</th><th>錄像</th></thead>
			<tbody>
			<?php
				foreach ($videos as $key => $video) 
				{
				  $video_url = site_url().'/worship/video/'.$video['id'];
				  $audio_url = site_url().'/worship/audio/'.$video['id'];
				  $download_url = site_url().'/worship/direct_download/'.$video['audio_name'];
					printf("<tr>");
					printf("<td>%s</td>", $video['date']);
					printf("<td>%s</td>", $video['title']);
					printf("<td>%s</td>", $video['speaker']);
					printf("<td><a href=\"%s\">", $download_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-volume-up\"></span></a></td>");
					printf("<td><a href=\"%s\">", $audio_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-headphones\"></span></a></td>");
					printf("<td><a href=\"%s\">", $video_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-facetime-video\"></span></a></td>");
					printf("</tr>");
				}
			?>
			</tbody>
		</table>
		<p><?php echo $links; ?></p>
	</div>
</div>