<div class="container">
	<div class="col-lg-12">
		<div class="page-header">
			<h2>主日信息 <a href="https://www.youtube.com/channel/UCtyV4FmPPsZpHNXht2aOcNA"><span style="font-family:Kaiti TC">(3/22/2020 之後信息 轉往YouTube頻道) </span></a>
				<?php
					if (Access::hasPrivilege(Access::PRI_UPDATE_WORSHIP))
					{
					  $url = site_url() . '/worship/addSundayMessage';
						printf('<a href="%s" class="btn btn-info btn-lg pull-right" role="button">添加信息</a>', $url);
					}
				?>
			</h2>
		</div>

		<table class="table table-striped table-hover">
			<thead><th>時間</th><th>信息</th><th>經文</th><th>講員</th><th>下載</th><th>收聽</th><th>錄像</th></thead>
			<tbody>
			<?php
				foreach ($videos as $key => $video) 
				{
                                  if ($video['date'] > "2020-03-16") {
				  $video_url = "https://bit.ly/398SoTB";
				  $audio_url = "https://bit.ly/398SoTB";
				  $download_url = "https://bit.ly/398SoTB";
                                  } else {
				  $video_url = site_url().'/worship/video/'.$video['id'];
				  $audio_url = site_url().'/worship/audio/'.$video['id'];
				  $download_url = site_url().'/worship/direct_download/'.$video['audio_name'];
                                  }
					printf("<tr id='sundaymessage-%s'>", $video['id']);
					printf("<td>%s</td>", $video['date']);
					printf("<td>%s</td>", $video['title']);
					printf("<td>%s</td>", Bible::convertEngRangesToCh($video['scripture']));
					printf("<td>%s</td>", $video['speaker']);
					printf("<td><a href=\"%s\">", $download_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-volume-up\"></span></a></td>");
					printf("<td><a href=\"%s\">", $audio_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-headphones\"></span></a></td>");
					printf("<td><a href=\"%s\">", $video_url);
					printf("&nbsp;&nbsp;<span class=\"glyphicon glyphicon-facetime-video\"></span></a></td>");
					
					// update/delete buttons
					if (Access::hasPrivilege(Access::PRI_UPDATE_WORSHIP))
					{
					  $url = site_url().'/worship/updateSundayMessage/'.$video['id'];
					  printf('<td><span class="pull-right"><a href="%s" class="btn btn-info btn-xs" role="button">更改</a>', $url);
					  
					  $delete_url = site_url().'/worship/deleteSundayMessage/'.$video['id'];
					  
					  # Delete button
					  printf('&nbsp;&nbsp;<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#%s" data-id="%s">刪除</button></span></td>', $video['id'], $video['id']);
					  
					  # Delete modal
					  printf('<div class="modal fade" id="%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">', $video['id']);
					  printf('<div class="modal-dialog">');
					  printf('<div class="modal-content">');
					  printf('<div class="modal-body">');
					  printf('刪除主日信息: '.$video['title']);
					  printf('</div>');
					  printf('<div class="modal-footer">');
					  printf('<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>');
					  printf('<button type="button" class="btn btn-danger" name="delete-sundaymessage" data-dismiss="modal" target-id="%s" url="%s">確認</button>', $video['id'], $delete_url);
					  printf('</div>');
					  printf('</div>');
					  printf('</div>');
					  printf('</div>');
					}

					printf("</tr>");
				}
			?>
			</tbody>
		</table>
		<p><?php echo $links; ?></p>
	</div>
</div>