<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo("charset"); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php bloginfo("name"); ?> - <?php bloginfo("description"); ?></title>
        
        <?php wp_head(); ?>
        
    </head>
	
    <body <?php body_class(); ?>>  
	<?php if(CFCNG_DEBUG) { echo "<pre>"; print_r( debug_backtrace() ); echo "</pre>"; } ?> 