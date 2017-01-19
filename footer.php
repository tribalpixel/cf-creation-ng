<?php /* DIAMANT */ ?>
<div class="row align-center">
    <div class="columns">
        <div class="diamant">
            <div class="diamant_wrapper">
                <div>				
                    <h4>Atelier sur rendez-vous</h4>
                    <?php echo get_theme_mod('cfcreation_tel'); ?><br />
                    <?php echo get_theme_mod('cfcreation_mobile'); ?><br /><br />
                    <a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a><br /><br />
                    <a href="javascript:void(0);" data-open="gmap"><img src="<?php echo get_template_directory_uri(); ?>/img/loc_icon.png" alt="google_map_link" title="Google Map" /></a>
                </div>                
            </div>            
        </div>
    </div>
</div>


<?php /* NAV */ ?>	
<div class="row align-center">
    <div class="columns">
        <div class="nav">
            
            <ul class="inline-list">
		<?php $current_lang = qtranxf_getLanguage();  ?>
                <?php if(CFCNG_DEBUG) {  var_dump($current_lang); } ?>
                <li><a data-open="contact"><?php echo ($current_lang == 'fr') ? 'Contact' : MENU_CONTACT_EN; ?></a></li>
                <li><a data-open="video"><?php echo ($current_lang == 'fr') ? 'Film d\'animation' : MENU_FILM_EN; ?></a></li>
                <li><a data-open="biographie"><?php echo ($current_lang == 'fr') ? 'Biographie' : MENU_BIO_EN; ?></a></li>
                <li><a data-open="presse"><?php echo ($current_lang == 'fr') ? 'Presse' : MENU_PRESSE_EN; ?></a></li>
                <li><a data-open="liens"><?php echo ($current_lang == 'fr') ? 'Liens' : MENU_LIENS_EN; ?></a></li>					
            </ul>            
        </div>
    </div>
</div> 

<?php /* SPONSORS BANNER */ ?>
<?php if (is_home()): ?>
    <div class="row align-center">
        <div class="columns">
            <div class="sponsor hidden_on_load" data-toggler data-animate="<?php echo get_theme_mod('cfcreation_modal_in_page'); ?>">
                <div class="loader">&nbsp;</div>
                <a href="<?php echo esc_url(get_permalink(34)); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/fairtrade_maxhavelaar_webbanner_large_f_2015.png" alt="fairetrade_maxhavelaar_webbanner" title="Fairetrade Maxhavelaar" /></a>
                <hr>
            </div>
        </div>
    </div>          
<?php endif; ?>

<?php /* FOOTER */ ?>
<div class="row align-center">
    <div class="columns">
        <div class="footer row">	
            <div class="copyright small-12 medium-6"><?php bloginfo('name'); ?> &copy; 2005-<?php echo date('Y'); ?> / <?php echo get_theme_mod('cfcreation_name'); ?></div>
            <?php
            // get theme options
            $cfcreation_fb = get_theme_mod('cfcreation_fb_settings');
            $cfcreation_fb_show = get_theme_mod('cfcreation_fb_footer');
            // show on page
            if (!empty($cfcreation_fb) && $cfcreation_fb_show == TRUE) : ?>
            <div class="fb-page small-12 medium-6" data-href="<?php echo $cfcreation_fb; ?>" data-height="70" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
                <blockquote cite="<?php echo $cfcreation_fb; ?>" class="fb-xfbml-parse-ignore">
                    <a href="<?php echo $cfcreation_fb; ?>">CF-Création Christel Falconnier</a>
                </blockquote>
            </div>
            <?php endif; ?>	
        </div>
        <hr>
        <div class="webdev">
            Site realisé par <a href="http://www.tribalpixel.ch" target="_blank">/[tribalpixel]\</a>
        </div>        
    </div>
</div>	

<?php
/* START MODAL BOXES */
$modal_in = get_theme_mod('cfcreation_modal_in');
$modal_out = get_theme_mod('cfcreation_modal_out');
?>

<?php /* GMAP */ ?>
<div id="gmap" class="large reveal" data-reveal>
    <div class="row">
        <div class="flex-video">
            <iframe width="970" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ch/maps?q=Bijouterie+CD+cf-cr%C3%A9ation&amp;hl=fr&amp;ie=UTF8&amp;cid=14674245541224973790&amp;gl=CH&amp;t=m&amp;ll=46.516351,6.641922&amp;spn=0.047251,0.16634&amp;z=15&amp;output=embed"></iframe>
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
    </button>
</div>

<?php /* CONTACT */ ?>
<div id="contact" class="reveal" data-reveal>
    <div class="row align-center">	
        <?php $page_id = 38;
        $page_data = get_page($page_id);
        ?>
        <div class="columns">
            <?php
            echo '<h2>' . apply_filters('the_title', $page_data->post_title) . '</h2>';
            echo apply_filters('the_content', $page_data->post_content);
            ?>
            <div>
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
    </div>	
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
    </button>
</div>

    <?php /* VIDEO */ ?>	
<div id="video" class="large reveal" data-reveal>
    <?php
    $page_data = get_page_by_title('Video');
    //echo '<h2>'. $page_data->post_title .'</h2>';
    ?>
    <div class="flex-video">
        <?php echo apply_filters('the_content', $page_data->post_content); ?>
<?php edit_post_link('Modifier', '', '', $page_data->ID); // link to edit content if user is logged in   ?>		
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
    </button>
</div>	

<?php /* BIOGRAPHIE */ ?>
<div id="biographie" class="large reveal" data-reveal>
    <div class="row align-center">
        <div class="columns">
            <?php
            $page_id = 32;
            $page_data = get_page($page_id);
            echo '<h2>' . apply_filters('the_title', $page_data->post_title) . '</h2>';
            //echo get_the_post_thumbnail($page_data->ID, 'full-page');
            echo apply_filters('the_content', $page_data->post_content);
            ?>
<?php edit_post_link('Modifier', '', '', $page_data->ID); // link to edit content if user is logged in   ?>
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
    </button>
</div>

<?php /* PRESSE */ ?>
<?php
$presse_query = new WP_Query(array('category_name' => 'presse', 'posts_per_page' => -1));

if ($presse_query->have_posts()) :
    ?> 	
    <div id="presse" class="reveal" data-reveal>
        <div class="row align-center">		
            <div class="columns">
                <h2>Presse</h2>
                <ul class="no-bullet presse">
                    <?php while ($presse_query->have_posts()) : $presse_query->the_post(); ?>                   
                            <?php //setup_postdata($presse_query->the_post());   ?>
                        <li><h3><?php the_title(); ?></h3>
                            <?php the_content(); ?><br />
                        <?php //edit_post_link(); // link to edit content if user is logged in  ?></li>		
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>	
            </div>
        </div>
        <button class="close-button" data-close aria-label="Close modal" type="button">
            <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
        </button>
    </div>
    <?php
endif;
wp_reset_postdata();
?>

<?php /* LINKS */ ?>
<div id="liens" class="reveal" data-reveal>
    <div class="row align-center">
        <div class="columns">
            <h2>Liens</h2>
            <ul class="inline-list links">
                <?php
                wp_list_bookmarks(array(
                    'category_order' => 'ASC',
                    'title_li' => '',
                    'title_before' => '<h3>',
                    'title_after' => '</h3>',
                    'class' => 'linkcat'
                ));
                ?>
            </ul> 		
        </div>
    </div>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&nbsp;&#215;&nbsp;</span>
    </button>
</div>


<?php /* END MODAL BOXES */ ?>
<?php if(wp_is_mobile()): ?>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/swipebox/js/jquery.swipebox.min.js'></script>
<?php else: ?>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.7.min.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.easing.pack.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.mousewheel.pack.js"></script>
<?php endif; ?>
<link rel='stylesheet' id='cf-creation-styles-overrides'  href='<?php echo get_stylesheet_directory_uri(); ?>/css/overrides.css' type='text/css' media='all' />
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.min.js"></script>
<script>
    jQuery(document).foundation();
    //jQuery(".gallery-icon a").fancybox().attr('rel', 'gallery');
</script>


<?php if (!is_tax() && !( is_page('travaux') || is_page(580) )): ?>
    <script>
        jQuery(document).ready(function ($) {
            $('.hidden_on_load').foundation('toggle');
            $('.loader').remove();
        });
    </script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>  