<?php /* FOOTER SLIDE */ ?>
<div class="row">
    <div class="small-12 centered columns">
        <hr />
        <div id="diamant">
            <div id="diamant_title">Atelier sur rendez-vous</div>
            <div id="diamant_content">				
                <?php echo get_theme_mod('cfcreation_tel'); ?><br />
                <?php echo get_theme_mod('cfcreation_mobile'); ?><br /><br />
                <a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a><br /><br />
                <a href="javascript:void(0);" id="open_gmap"> >> google map</a>
            </div>
            <div id="diamant_bg"></div> 	
        </div>
    </div>
</div>

<?php /* NAV */ ?>	
<div class="row">
    <div class="small-12 centered columns">
        <div id="footer_nav">
            <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'items_wrap' => '<ul id="%1$s" class="%2$s inline-list">%3$s</ul>',)); ?>
        </div>
    </div>
</div>  

<?php /* COPYRIGHT */ ?>
<div class="row">
    <div class="small-12 centered columns">
        <div id="footer">	
            <span class="coypright"><?php bloginfo('name'); ?> &copy; 2005-<?php echo date('Y'); ?> / <?php echo get_theme_mod('cfcreation_name'); ?></span>
            <?php
            // get theme options
            $cfcreation_fb = get_theme_mod('cfcreation_fb_settings');
            $cfcreation_fb_show = get_theme_mod('cfcreation_fb_footer');
            // show on page
            if (!empty($cfcreation_fb) && $cfcreation_fb_show == TRUE) {
                //echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=' . urlencode($cfcreation_fb) . '&amp;width=330&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:330px; height:62px;" allowTransparency="true"></iframe>';
            }
            ?>	
        </div>
    </div>
</div>	

<?php wp_footer(); ?>
</body>
</html>  