<div class="row well">
    <div class="col-lg-12">
        <blockquote>
            <p>
            普天下當向耶和華歡呼。你們當樂意事奉耶和華．當來向他歌唱。<br/>
            你們當曉得耶和華是　神．我們是他造的、也是屬他的．我們是他的民、也是他草場的羊。<br/>
            <br/>
            當稱謝進入他的門、當讚美進入他的院．當感謝他、稱頌他的名。<br/>
            因為耶和華本為善．他的慈愛、存到永遠、他的信實、直到萬代。<br/>
            </p>

            <cite class="pull-right">詩 篇 100 篇</cite>
        </blockquote>

        <div class="page-header">
            <h2>禱告事項 <small><?php print date('Y年m月d日', strtotime($scripture['date']));?></small>
            <a href="<?php echo site_url()?>/prayer/prayerhistory" class="btn btn-info btn-lg pull-right" role="button">禱告歷史</a>
            <a href="<?php echo site_url()?>/prayer/addprayer" class="btn btn-info btn-lg pull-right btn-addprayer" role="button">添加本週禱告</a></h2>
        </div>
        <div class="alert alert-info">
            	同聲朗讀經文<br/>
            	<?php print $scripture['text']; ?>
           		<br/>
        </div>
        
        <?php
            $currentSection = 0;
            $currentSectionIndex = -1;
            foreach ($items as $key => $item)
            { 
                if($item['section_id'] > $currentSection)
                {
                    if($currentSection > 0)
                    {
                        printf('</ol></ul>');
                    }
                    $currentSection = $item['section_id'];
                    $currentSectionIndex += 1;
                    printf('<ul>');
                    printf('%c. %s', ord('A') + $currentSectionIndex, $item['section_name'] );
                    printf('<ol>');         
                }
                printf('<li>%s</li>', $item['item_name']);
            }
            if($currentSection > 0)
            {
                printf('</ol></ul>');
            }           
        ?>
    </div>
</div>