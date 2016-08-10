<?php /* FOOTER */ ?>
<div class="row">
    <div class="small-12 centered columns">
        <hr />
        <div id="diamant">
            <div id="diamant_wrapper">
                <div id="diamant_title">Atelier sur rendez-vous</div>
                <div id="diamant_content">				
                    <?php echo get_theme_mod('cfcreation_tel'); ?><br />
                    <?php echo get_theme_mod('cfcreation_mobile'); ?><br /><br />
                    <a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a><br /><br />
                    <a href="javascript:void(0);" data-open="gmap"> >> google map</a>
                </div>
                <div id="diamant_bg"></div>
            </div>            
        </div>
    </div>
</div>

<?php /* NAV */ ?>	
<div class="row">
    <div class="small-12 centered columns">
        <div id="footer_nav">
            <?php //wp_nav_menu(array('theme_location' => 'footer_menu', 'items_wrap' => '<ul id="%1$s" class="%2$s inline-list">%3$s</ul>',)); ?>
            <?php $currentLang = qtranxf_getLanguage(); ?>
            <ul class="menu inline-list">
                <li><a data-open="contact"><?php echo ($currentLang == 'fr') ? 'Contact' : MENU_CONTACT_EN; ?></a></li>
                <li><a data-open="video"><?php echo ($currentLang == 'fr') ? 'Film d\'animation' : MENU_FILM_EN; ?></a></li>
                <li><a data-open="biographie"><?php echo ($currentLang == 'fr') ? 'Biographie' : MENU_BIO_EN; ?></a></li>
                <li><a data-open="presse"><?php echo ($currentLang == 'fr') ? 'Presse' : MENU_PRESSE_EN; ?></a></li>
                <li><a data-open="liens"><?php echo ($currentLang == 'fr') ? 'Liens' : MENU_LIENS_EN; ?></a></li>					
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
                echo '<iframe src="//www.facebook.com/plugins/likebox.php?href=' . urlencode($cfcreation_fb) . '&amp;width=330&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:330px; height:62px;" allowTransparency="true"></iframe>';
            }
            ?>	
        <div>
            <span class="copyright">site realisé par <a href="http://www.tribalpixel.ch" target="_blank">Tribalpixel aka Ludovic Bortolotti</a></span>
        </div>
        </div>
    </div>
</div>	

<?php /* START MODAL BOXES */ ?>

<?php /* GMAP */ ?>
<div id="gmap" class="reveal large" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <div class="row">
        <div class="flex-video">
            <iframe width="970" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ch/maps?q=Bijouterie+CD+cf-cr%C3%A9ation&amp;hl=fr&amp;ie=UTF8&amp;cid=14674245541224973790&amp;gl=CH&amp;t=m&amp;ll=46.516351,6.641922&amp;spn=0.047251,0.16634&amp;z=15&amp;output=embed"></iframe>
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&#215;</span>
    </button>
</div>

<?php /* CONTACT */ ?>
<div id="contact" class="reveal large" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <div class="row">	
        <?php
        $page_id = 38;
        $page_data = get_page($page_id);
        echo '<h2>' . apply_filters('the_title', $page_data->post_title) . '</h2>';
        ?>
        <div class="small-12 large-8 columns">
            <?php echo apply_filters('the_content', $page_data->post_content); ?>
        </div>
        <div class="small-12 large-4 columns">
            <h3><?php bloginfo('name'); ?></h3>
            <p>
                <strong><?php echo get_theme_mod('cfcreation_name'); ?></strong><br />
                <?php echo get_theme_mod('cfcreation_infos1'); ?><br />
                <?php echo get_theme_mod('cfcreation_infos2'); ?><br /><br />
                <?php echo get_theme_mod('cfcreation_tel'); ?><br />
                <?php echo get_theme_mod('cfcreation_mobile'); ?><br /><br />
                <a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a><br />
            </p>
        </div>
    </div>	
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&#215;</span>
    </button>
</div>

<?php /* VIDEO */ ?>	
<div id="video" class=" small reveal large" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <?php
    $page_data = get_page_by_title('Video');
    //echo '<h2>'. $page_data->post_title .'</h2>';
    ?>
    <div class="flex-video">
        <?php echo apply_filters('the_content', $page_data->post_content); ?>
        <?php edit_post_link('Modifier', '', '', $page_data->ID); // link to edit content if user is logged in ?>		
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&#215;</span>
    </button>
</div>	

<?php /* BIOGRAPHIE */ ?>
<div id="biographie" class="reveal large" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
    <div class="row">
        <div class="small-12 columns">
            <?php
            $page_id = 32;
            $page_data = get_page($page_id);
            echo '<h2>' . apply_filters('the_title', $page_data->post_title) . '</h2>';
            //echo get_the_post_thumbnail($page_data->ID, 'full-page');
            echo apply_filters('the_content', $page_data->post_content);
            ?>
            <?php edit_post_link('Modifier', '', '', $page_data->ID); // link to edit content if user is logged in ?>
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&#215;</span>
    </button>
</div>

<?php /* PRESSE */ ?>
    <?php
    $presse_query = new WP_Query(array('category_name' => 'presse', 'posts_per_page' => -1 ));
    
    if ($presse_query->have_posts()) :
        
    ?> 	
    <div id="presse" class="large reveal" data-reveal data-close-on-click="true" data-animation-in="fade-in" data-animation-out="fade-out">
        <div class="row">		
            <div class="small-12 columns">
                <h2>Presse</h2>
                <ul class="row small-up-1 large-up-4">
                    <?php while ($presse_query->have_posts()) : $presse_query->the_post(); ?>                   
                        <?php //setup_postdata($presse_query->the_post()); ?>
                        <li class="columns"><h3 class="presse-title"><?php the_title(); ?></h3>
                        <?php the_content(); ?><br />
                    <?php //edit_post_link(); // link to edit content if user is logged in  ?></li>		
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>	
            </div>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&#215;</span>
        </button>
    </div>
<?php endif; wp_reset_postdata();?>

<?php /* LIENS */ ?>
<div id="liens" class="large reveal" data-reveal data-close-on-click="true" data-animation-in="false" data-animation-out="false" data-options="animation:none">
    <div class="row">
        <div class="small-12 columns">
            <h2 class="liens-title">Liens</h2>
            <ul class="small-up-1 medium-up-2 large-up-4">
                <?php
                wp_list_bookmarks(array(
                    'category_order' => 'DESC',
                    'title_li' => '',
                    'title_before' => '<h3 class="liens-title">',
                    'title_after' => '</h3>',
                    'class' => 'columns linkcat'
                ));
                ?>
            </ul> 		
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&#215;</span>
    </button>
</div>


<?php /* END MODAL BOXES */ ?>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/slick/slick.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.7.min.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.easing.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.mousewheel.pack.js"></script>
<link rel='stylesheet' id='cf-creation-styles-overrides'  href='<?php echo get_stylesheet_directory_uri(); ?>/css/overrides.css' type='text/css' media='all' />
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.min.js"></script>
<script>
    jQuery(document).foundation();
    jQuery(".gallery-icon a").fancybox().attr('rel', 'gallery');
</script>

<?php if (is_home()) : ?>
    <style>
        h2,h3,h4,h5,h6 { text-align: center; }
    </style>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>  