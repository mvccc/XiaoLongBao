<div class="container">
	<div class="col-lg-12">
		<div class="page-header">
			<h1>教牧同工</h1>
		</div>
        <div class="row mvccc-wrapper-row">
            <div class="col-lg-4">
                <div class="mvccc-profile-img">
                    <img src="<?php echo base_url(); ?>/assets/img/pastor_sun.jpg"/>
                </div>
            </div>
            <div class="col-lg-8">
                <h3>中文堂顧問牧師：孫通牧師 Rev. Tong Sun</h3>
                <p>孫牧師出生於中國一个基督徒家庭，12歲時因父母所傳得以認識耶穌基督，並成為基督徒。大學主修建築專業，後出國留學得碩士學位。於工作10年之後，蒙神感召與妻子同赴新加坡神學院，完成道學碩士學位(M.Div.)，後赴美繼續進修。神學畢業後，於2000-2005年在本教會全職牧養教會，並按立成為牧師。後去神學院參與神學教育，現任北美基督神學院院長暨舊約教授，經常赴海外宣教，參與神學培訓。孫牧師與師母共育有四子女。</p>
                <p>email: wesun@hotmail.com</p>
            </div>
        </div>
        <div class="row mvccc-wrapper-row">
            <div class="col-lg-4">
                <div class="mvccc-profile-img">
                    <img src="<?php echo base_url(); ?>/assets/img/pastor_quon.jpg"/>
                </div>
            </div>
            <div class="col-lg-8"> 
                <h3>英文堂顧問牧師：Rev. Victor Quon</h3>
                <p>email: victor.intersect@gmail.com </p>
            </div>
        </div>
        <div class="row mvccc-wrapper-row">
            <div class="col-lg-4">
                <div class="mvccc-profile-img">
                    <img src="<?php echo base_url(); ?>/assets/img/minister_yang.jpg"/>
                </div>
            </div>
            <div class="col-lg-8"> 
                <h3>教會傳道：楊東傳道 Minister. Bill Yang </h3>
                <p>楊東傳道出生於中國北京，成長過程中深受無神論教育的影響。大學主修EE半導體集成電路設計專業，後出國在思科公司工作25年。於2009受洗歸入基督的名下，在教會的服事中感到自己對神話語認識的不足，用業餘時間到北美基督神學院進修。2017年蒙神呼召預備全時間服事，2020年完成道學碩士學位(M.Div.)，在加州山景城中國基督教會牧會。楊傳道與師母共育有兩名子女。</p>
                <p>email: byang1110@gmail.com</p>
            </div>
        </div>		<?php
			foreach ($pastors as $key => $pastor) 
			{
				$imgName = $pastor['img'];
				$imgPath = '';
				if (!empty($imgName))
				{
					$imgPath = base_url() . '/assets/img/' . $pastor['img'];
				}
				printf('<div class="row">');
				printf('<div class="col-lg-3">');
				printf('<img class="img-circle pull-right" src="%s" width="130px" height="150px"/>', $imgPath);
				printf('</div>');
				printf('<div class="col-lg-8">');
				printf('<b>%s %s</b><br/>', $pastor['name'], $pastor['position']);
				printf('<i>%s</i><br/>', $pastor['title']);
				if (!empty($pastor['email']))
				{
					printf('<i>%s</i><br/>', $pastor['email']);
				}
				printf('<br/>');
				printf('<p>%s</p>', $pastor['desc']);
				printf('</div></div>');
				printf('<br><br>');
			}
		?>
	</div>
</div>