<?php
/* 
 * Header 7 Layout
 */
?>
<?php do_action('kemet_before_main_header'); ?>
<div class="main-header-bar-wrap ss-wrapper">
    <div class="menu-icon-social">
        <div class="menu-icon">
            <a id="nav-icon" class="icon-bars-btn">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
    </div>
	<div class="main-header-bar ss-content">
		<?php kemet_main_header_bar_top(); ?>
        <div id="header-layout-7" class="header">
                <div class="kmt-flex main-header-container">
                    <?php kemet_sitehead_content(); ?>
                </div>
		<?php kemet_main_header_bar_bottom(); ?>
	</div> 
</div>
<?php do_action('kemet_after_main_header'); ?>