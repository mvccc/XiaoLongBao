<div class="row well">
    <br><br>
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal" role="form" method="post" accept-charset="utf-8" action="<?php echo site_url().'/pages/doCreateEvent/'?>">
            <div class="form-group">
                <label class="col-lg-2 control-label">日期</label>
                <div class="col-lg-10">
                    <div class="input-group date" id="dp3" data-date="<?php echo $today?>" data-date-format="mm-dd-yyyy">
                        <input class="form-control" type="text" readonly="" value="<?php echo $today?>" name="date">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">時間</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="time" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">標題</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="title" placeholder="標題">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">類別</label>
                <div class="col-lg-10">
                    <select class="form-control" name="category">
                        <option>活動</option>
                        <option>消息 </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">內容</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="10" name="content"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-default">添加</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script>
    $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
    </script>