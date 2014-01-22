<div class="row well">
    <div class="col-lg-12">
        <div class="event-header">
            <div class="col-lg-6">
                <ul class="pager event-header-left pull-left">
                    <li><a href="<?php printf("%s/events/eventList/%s/%s/%s", site_url(), $lang, $previous['year'], $previous['month']);?>"><?php echo $this->lang->line('button_previous')?></a></li>
                    <li><a href="<?php printf("%s/events/eventList/%s", site_url(), $lang); ?>"><?php echo $this->lang->line('button_today')?></a></li>
                    <li><a href="<?php printf("%s/events/calendar/%s", site_url(), $lang); ?>"><?php echo $this->lang->line('button_calendar')?></a></li>
                    <li><a href="<?php printf("%s/events/eventList/%s/%s/%s", site_url(), $lang, $next['year'], $next['month']);?>"><?php echo $this->lang->line('button_next')?></a></li>
                    <?php
                        $logged_in = $this->session->userdata('logged_in');
                        if(isset($logged_in) && $logged_in == TRUE)
                        {
                            $url = site_url() . "/events/createEvent/" . $lang;
                            printf('<li><a href="%s">%s</a></li>', $url, $this->lang->line('button_create'));
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
                $dateTime = DateTime::createFromFormat('Y-m-d', $event['date']);
                $dateTime->setTimeZone(new DateTimeZone("America/Los_Angeles"));
                # $dateTime->setTimestamp($event['timestamp']);
                $weekDay  = $dateTime->format('D');

                # Get the month name in the short form.
                $this->calendar->month_type = "short";
                $_month = $this->calendar->get_month_name($dateTime->format('m'));
                $_day  = $dateTime->format('d');

                # Delete event URL.
                $deleteEventUrl = site_url() . '/events/doDeleteEvent/' . $event['id'];

                # Update event URL.
                $updateEventUrl = site_url() . '/events/updateEvent/' . $event['id'];


                printf('<div class="event-list" id="event-%s">', $event['id']);

                printf('<div class="col-lg-3">');
                printf('<div class="event-date pull-right">');
                printf('<div class="event-day">%s</div>', $_day);
                printf('<div class="event-mon">%s</div>', $_month);
                printf('</div>');
                printf('</div>');

                printf('<div class="col-lg-6 event-title">');
                printf('<h4><a href="#">%s</a></h4>', $event['title']);
                printf('<small>%s | %s</small>', $weekDay, $event['start_time']);
                printf('<span class="label %s">%s</span>',$categoryLabel, $category);
                printf('</div>');

                printf('<div class="col-lg-3">');
                printf('<button class="btn btn-info" data-toggle="modal" data-target="#detail-%s">詳細內容</button>', $event['id']);

                # Modal for event detail.
                printf('<div class="modal fade" id="detail-%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">', $event['id']);
                printf('<div class="modal-dialog">');
                printf('<div class="modal-content">');
                printf('<div class="modal-header">');
                printf('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>');
                printf('<h4 class="modal-title" id="myModalLabel">%s</h4>', $event['title']);
                printf('</div>');
                printf('<div class="modal-body">');
                printf('<small>%s | %s</small>', $weekDay, $event['start_time']);
                printf('<p>%s</p>', $event['content']);
                printf('</div>');
                printf('<div class="modal-footer">');
                printf('<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>');
                printf('</div>');
                printf('</div>');
                printf('</div>');
                printf('</div>');


                $logged_in = $this->session->userdata('logged_in');
                if(isset($logged_in) && $logged_in == TRUE)
                {
                    # Update button
                    printf('&nbsp;');
                    printf('<a href="%s" class="btn btn-warning" role="button">更改</a>', $updateEventUrl);
                    printf('&nbsp;');

                    # Delete button
                    printf('<button class="btn btn-danger" data-toggle="modal" data-target="#%s">刪除</button>', $event['id']);

                    # Delete modal
                    printf('<div class="modal fade" id="%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">', $event['id']);
                    printf('<div class="modal-dialog">');
                    printf('<div class="modal-content">');
                    printf('<div class="modal-header">');
                    printf('<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>');
                    printf('<h4 class="modal-title" id="myModalLabel">%s</h4>', $event['title']);
                    printf('</div>');
                    printf('<div class="modal-body">');
                    printf('<small>%s | %s</small>', $weekDay, $event['start_time']);
                    printf('<p>%s</p>', $event['content']);
                    printf('</div>');
                    printf('<div class="modal-footer">');
                    printf('<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>');
                    printf('<button type="button" class="btn btn-danger" name="delete-event" data-dismiss="modal" target-id="%s" url="%s">刪除</button>', $event['id'], $deleteEventUrl);
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