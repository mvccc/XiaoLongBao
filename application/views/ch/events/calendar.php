<div class="row well">
    <div class="col-lg-12">
        <div class="row event-header">
            <div class="col-lg-6">
                <ul class="pager event-header-left pull-left">
                    <li><a href="<?php printf("%s/pages/calendar/%s/%s", site_url(), $previous['year'], $previous['month']);?>">Previous</a></li>
                    <li><a href="<?php echo site_url();?>/pages/calendar">今天</a></li>
                    <li><a href="<?php printf("%s/pages/calendar/%s/%s", site_url(), $next['year'], $next['month']);?>">Next</a></li>
                    <?php
                        $logged_in = $this->session->userdata('logged_in');
                        if(isset($logged_in) && $logged_in == TRUE)
                        {
                            $url = site_url() . "/pages/createEvent";
                            printf('<li><a href="%s">創建</a></li>', $url);
                        } 
                    ?>
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

                # Get the weekday name from timestamp.
                $weekDay = '';
                if (isset($event['timestamp']))
                {
                    $dateTime = new DateTime();
                    $dateTime->setTimeZone(new DateTimeZone("America/Los_Angeles"));
                    $dateTime->setTimestamp($event['timestamp']);
                    $weekDay  = $dateTime->format('D');
                }

                # Get the month name in the short form.
                $this->calendar->month_type = "short";
                $_month = $this->calendar->get_month_name($event['month']);

                # Delete event URL.
                $deleteEventUrl = site_url() . '/pages/doDeleteEvent/' . $event['_id'];

                # Update event URL.
                $updateEventUrl = site_url() . '/pages/updateEvent/' . $event['_id'];


                printf('<div class="event-list" id="event-%s">', $event['_id']);

                printf('<div class="col-lg-3">');
                printf('<div class="event-date pull-right">');
                printf('<div class="event-day">%s</div>', $event['day']);
                printf('<div class="event-mon">%s</div>', $_month);
                printf('</div>');
                printf('</div>');

                printf('<div class="col-lg-6 event-title">');
                printf('<h4><a href="#">%s</a></h4>', $event['title']);
                printf('<small>%s | %s</small>', $weekDay, $event['time']);
                printf('<span class="label %s">%s</span>',$categoryLabel, $category);
                printf('</div>');

                printf('<div class="col-lg-3">');
                printf('<a href="#" class="btn btn-info" role="button">詳細內容</a>');

                $logged_in = $this->session->userdata('logged_in');
                if(isset($logged_in) && $logged_in == TRUE)
                {
                    # Update button
                    printf('&nbsp;');
                    printf('<a href="%s" class="btn btn-warning" role="button">更改</a>', $updateEventUrl);
                    printf('&nbsp;');

                    # Delete button
                    printf('<button class="btn btn-danger" data-toggle="modal" data-target="#%s">刪除</button>', $event['_id']);

                    # Delete modal
                    printf('<div class="modal fade" id="%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">', $event['_id']);
                    printf('<div class="modal-dialog">');
                    printf('<div class="modal-content">');
                    printf('<div class="modal-header">');
                    printf('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>');
                    printf('<h4 class="modal-title" id="myModalLabel">%s</h4>', $event['title']);
                    printf('</div>');
                    printf('<div class="modal-body">');
                    printf('...');
                    printf('</div>');
                    printf('<div class="modal-footer">');
                    printf('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
                    printf('<button type="button" class="btn btn-primary" name="delete-event" data-dismiss="modal" target-id="%s" url="%s">刪除</button>', $event['_id'], $deleteEventUrl);
                    printf('</div>');
                    printf('</div>');
                    printf('</div>');
                    printf('</div>');
                }
                printf('</div>');

                printf('</div>');
            }
        ?>
    </div>
</div>

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