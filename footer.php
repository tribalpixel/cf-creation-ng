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
            <?php //wp_nav_menu(array('theme_location' => 'footer_menu', 'items_wrap' => '<ul id="%1$s" class="%2$s inline-list">%3$s</ul>',)); ?>
            <ul class="inline-list">
                <li><a href="#" data-open="contact">Contact</a></li>
                <li><a href="#" data-open="video">Film d'animation</a></li>
                <li><a href="#" data-open="biographie">Biographie</a></li>
                <li><a href="#" data-open="presse">Presse</a></li>
                <li><a href="#" data-open="liens">Liens</a></li>					
            </ul>            
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

<?php /* START MODAL BOXES */ ?>

<?php /* LIENS */ ?>
<!--
<div id="liens" class="reveal" data-reveal>
    <div class="row">
        <h2>Liens</h2>
        <ul class="small-block-grid-1 large-block-grid-4">
            <?php
            wp_list_bookmarks(array(
                'category_order' => 'DESC',
                'title_li' => '',
                'title_before' => '<h3>',
                'title_after' => '</h3>',
            ));
            ?>
        </ul> 		
    </div>

            <button class="close-button" data-close aria-label="Close modal" type="button">
          <span aria-hidden="true">&#215;</span>
        </button>
</div>
-->

<?php /* END MODAL BOXES */ ?>
<link rel='stylesheet' id='cf-creation-styles-overrides'  href='<?php echo get_stylesheet_directory_uri(); ?>/css/overrides.css' type='text/css' media='all' />
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.reveal.js"></script>
<script>
    jQuery(document).foundation();
</script>

<?php wp_footer(); ?>
</body>
</html>  