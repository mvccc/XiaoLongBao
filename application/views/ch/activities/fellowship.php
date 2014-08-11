<div class="container">
	<div class="row well">
		<div class="col-lg-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo site_url().'/pages/fellowships'?>">團契生活</a></li>
				<li class="active"><a href="#"><?php echo $fellowship['name'] ?></a></li>
			</ol>
			<div class="page-header">
				<h1><?php echo $fellowship['name'] ?></h1>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<p><?php echo $fellowship['desc']?></p>
					<dl class="dl-horizontal">
						<dt>地點:</dt> <dd><?php echo $fellowship['location']?></dd>
						<dt>時間:</dt> <dd><?php echo $fellowship['time']?> </dd>
						<dt>聯系人:</dt> <dd><?php echo $fellowship['contact']?></dd>
						<dt>郵件:</dt> <dd><?php echo $fellowship['email']?></dd>
						<dt>電話:</dt> <dd><?php echo $fellowship['tel']?></dd>
					</dl>
				</div>
				<div class="col-lg-6">
					<img data-src="holder.js/100%x250/auto/gray:#ffffff/text:Fellowship Photo" alt="Fellowship Photo">
				</div>
			</div>
		</div>
	</div>
</div>