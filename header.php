<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo("charset"); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php bloginfo("name"); ?> - <?php bloginfo("description"); ?></title>
 
        <link rel="shortcut icon" href="<?php echo site_url(); ?>/favicon.ico">
        <link rel="apple-touch-icon" href="<?php echo site_url(); ?>/apple-touch-icon.png">        
        
        <link rel='stylesheet' id='cf-creation-slick-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick.css' type='text/css' media='all' />
        <link rel='stylesheet' id='cf-creation-slick-theme-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/slick/slick-theme.css' type='text/css' media='all' />
        <link rel='stylesheet' id='cf-creation-fancybox-css'  href='<?php echo get_stylesheet_directory_uri(); ?>/fancybox/jquery.fancybox-1.3.7.min.css' type='text/css' media='all' />

        <?php wp_head(); ?>
        
    </head>
	
    <body <?php body_class(); ?>>  
        
	<?php if(CFCNG_DEBUG) { echo "<pre>"; print_r( debug_backtrace() ); echo "</pre>"; } ?>
        
        <?php /* LOGO */ ?>	
        <div class="row align-center">
            <div class="columns">
                <div class="logo">
                    <h1><?php bloginfo('name'); ?>, <?php bloginfo('description'); ?>, <?php echo get_theme_mod('cfcreation_name'); ?></h1>
                    <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_cfcreation.png" alt="CF-Creation logo" width="321" height="135" /></a>
                </div>
            </div>
        </div>		

        <?php /* ADDRESS */ ?>	
        <div class="row align-center">
            <div class="columns">
                <div class="address">
                    <ul class="inline-list">
                        <li class="show-for-medium"><?php echo get_theme_mod('cfcreation_name'); ?></li>
                        <li class="show-for-medium">|</li>
                        <li class="show-for-large"><?php echo get_theme_mod('cfcreation_infos1'); ?> </li>
                        <li class="show-for-large">|</li>
                        <li class="show-for-large"><?php echo get_theme_mod('cfcreation_infos2'); ?> </li>
                        <li class="show-for-large">|</li>
                        <li><?php echo get_theme_mod('cfcreation_mobile'); ?> </li>
                        <li class="show-only-above-small-portrait">|</li>
                        <li><a href="mailto:<?php echo get_theme_mod('cfcreation_email'); ?>" ><?php echo get_theme_mod('cfcreation_email'); ?></a></li>						  
                    </ul>
                </div>
            </div>
        </div>

        <?php /* NAV */ ?>	
        <div class="row align-center">
            <div class="columns">               
                <?php wp_nav_menu( array(
                    'theme_location' => 'header_menu',  
                    'container_class'=>'nav',
                    'menu_class'=>'inline-list',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                )); ?>
            </div>
        </div>    