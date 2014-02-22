<ul class="nav nav-tabs">
    <li class="<?php echo $this->uri->segment(3) == 'introduction' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/introduction/<?php echo $lang; ?>">Introduction</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'schedule' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/schedule/<?php echo $lang; ?>">Schedule</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'leader' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/leader/<?php echo $lang; ?>">Awana Leader</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'rules' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/rules/<?php echo $lang; ?>">Rules</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'information' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/information/<?php echo $lang; ?>">Other Information</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'gallery' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/gallery/<?php echo $lang; ?>">Gallery</a>
    </li>
    <li class="<?php echo $this->uri->segment(3) == 'forms' ? 'active' : '';?>">
        <a href="<?php echo site_url(); ?>/pages/awana/forms/<?php echo $lang; ?>">Forms</a>
    </li>
</ul>