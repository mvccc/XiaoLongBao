<div class="row well">
    <br><br>
    <div class="col-lg-8 col-lg-offset-2">
        <form class="form-horizontal" role="form"
          method="post" accept-charset="utf-8" action="<?php echo site_url().'/worship/addSundayMessage/' ?>">
            <div class="form-group">
                <label class="col-lg-2 control-label">日期</label>
                <div class="col-lg-10">
                    <div class="input-group date" id="dp1" data-date="<?php echo date("Y-m-d")?>" data-date-format="yyyy-mm-dd">
                        <input class="form-control" type="text" readonly="" value="<?php echo date("Y-m-d")?>" name="date">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                    </div>
                    <?php echo form_error('date'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">信息</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="title" placeholder="信息" value="<?php echo set_value('title'); ?>">
                    <?php echo form_error('title'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">講員</label>
                <div class="col-lg-10">
                    <div id="myCombobox" class="dropdown combobox">
                        <input class="mvccc_combobox_input" type="text" name="speaker" value="<?php echo set_value('speaker'); ?>"/>
                        <button type="button" class="btn btn-default mvccc_combobox_button" data-toggle="dropdown"><i class="caret"></i></button>
                        <ul class="dropdown-menu">
                            <li data-value="1"><a href="#">劉同蘇牧師</a></li>
                            <li data-value="2"><a href="#">侯君麗牧師</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-lg-offset-2">
                <?php echo form_error('speaker'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">視頻</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="video" value="<?php echo date("Y-m-d").'.flv'?>">
                    <?php echo form_error('video'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">音頻</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="audio" value="<?php echo date("Y-m-d").'.mp3'?>">
                    <?php echo form_error('audio'); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-2 control-label">經文</label>
                <div class="col-lg-10">
                    <textarea class="form-control" rows="10" name="scripture"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-info">添加</button>
                    <a href="<?php echo site_url(); ?>/worship/index" class="btn btn-default" role="button">取消</a>
                </div>
            </div>
        </form>
    </div>
</div>