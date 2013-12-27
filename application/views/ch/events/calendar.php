<div class="row well">
	<div class="col-lg-12">
		<div class="row event-header">
			<div class="col-lg-6">
				<ul class="pager event-header-left pull-left">
					<li><a href="<?php printf("%s/pages/calendar/%s/%s", site_url(), $previous['year'], $previous['month']);?>">Previous</a></li>
					<li><a href="<?php echo site_url();?>/pages/calendar">今天</a></li>
					<li><a href="<?php printf("%s/pages/calendar/%s/%s", site_url(), $next['year'], $next['month']);?>">Next</a></li>
					<li><a href="<?php echo site_url();?>/pages/createEvent">創建</a></li>
				</ul>
			</div>
			<div class="col-lg-6">
				<div class="pager event-header-right pull-right"><?php printf("%s %s", $current['month'], $current['year']);?></div>
			</div>
		</div>

		<?php
			foreach ($events as $key => $event) 
			{
				$category = $event['category'];
				$categoryLabel = "label-info";
				if ($category == '活動')
				{
					$categoryLabel = "label-danger";
				}
				printf('<div class="event-list">');
				printf('<div class="col-lg-3">');
				printf('<div class="event-date pull-right">');
				printf('<div class="event-day">%s</div>', $event['day']);
				printf('<div class="event-mon">%s</div>', $event['month']);
				printf('</div>');
				printf('</div>');
				printf('<div class="col-lg-6 event-title">');
				printf('<h4><a href="#">%s</a><h4>', $event['title']);
				printf('<small>%s | %s</small>', '星期', $event['time']);
				printf('<span class="label %s">%s</span>',$categoryLabel, $category);
				printf('</div>');
				printf('<div class="col-lag-3">');
				printf('<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>');
				printf('</div>');
				printf('</div>');
			}
		?>
		<!--
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						30
					</div>
					<div class="event-mon">
						Nov
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">轉會申請</a><h4>
				<small>申請截止: 星期六</small>
				<span class="label label-info">消息</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>

		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						30
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">聯合團契, Awana 暫停一週</a><h4>
				<small>星期六 | 7:00 pm - 9:00 pm</small>
				<span class="label label-info">消息</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						29
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">真理團契 暫停一週</a><h4>
				<small>星期五 | 7:00 pm - 9:00 pm</small>
				<span class="label label-info">消息</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						28
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">姐妹團契 暫停一週</a><h4>
				<small>星期四</small>
				<span class="label label-info">消息</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						27
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">松柏團契 暫停一週</a><h4>
				<small>星期三</small>
				<span class="label label-info">消息</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						24
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">感恩節洗禮</a><h4>
				<small>星期日 | 11:00 am - 12:00 am</small>
				<span class="label label-danger">事件</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>		
		<div class="event-list">
			<div class="col-lg-3">
				<div class="event-date pull-right">
					<div class="event-day">
						23
					</div>
					<div class="event-mon">
						NOV
					</div>
				</div>
			</div>
			<div class="col-lg-6 event-title">
				<h4><a href="#">感恩見証會</a><h4>
				<small>星期六 | 7:00 pm - 9:00 pm</small>
				<span class="label label-danger">事件</span>
			</div>
			<div class="col-lag-3">
				<a href="#" class="btn btn-info btn-default pull-right" role="button">詳細內容</a>
			</div>
		</div>
	</div>
	-->
</div>