<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Meta -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body data-spy="scroll" data-offset="80" <?php body_class(); ?>>
<!-- START PRELOADER -->
<div class="preloader">
    <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
</div>
<!-- END PRELOADER -->

<!-- START NAVBAR -->
<div class="navbar navbar-default navbar-fixed-top menu-top">
    <div class="container">
        <div class="logo">
			<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );

			if ( has_custom_logo() ) {
				echo '<a href="<?php echo esc_url( site_url() ) ?>" class="navbar-brand"><img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
			} else {
				?>
                <a href="<?php echo esc_url( site_url() ) ?>" class="navbar-brand">
                    <p><?php echo get_bloginfo( 'name' ) ?></p></a>
				<?php
			} ?>
            <div class="mobile-nav"></div>
        </div>
            <?php
                wp_nav_menu(array(
	                'container_class'      => 'main_menu',
	                'container_id'         => 'navbar',
	                'menu_class'           => 'menu nav navbar-nav navbar-right',
	                'theme_location'       => 'main-menu',
                ));
            ?>
    </div><!--- END CONTAINER -->
</div>
<!-- END NAVBAR -->