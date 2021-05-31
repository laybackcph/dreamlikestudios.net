<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php do_action('lb_after_body_tag'); ?>

	<div id="header" class="site-header">
		<div class="inner">
			<a class="site-logo" href="<?php echo esc_url( home_url() ); ?>">
				<?php 				
					$custom_logo_id = get_theme_mod( 'custom_logo' );
					if($custom_logo_id)
					{
						svgimage($custom_logo_id);
					}
					else
					{
						if(get_theme_mod('company'))
						{
							echo '<h1>' . get_theme_mod('company') . '</h1>';
						}
						else
						{
							echo '<h1>Company #1</h1>';
						}
					}
				?>
			</a>
			<nav class="site-navigation col-md col-lg">
				<?php 
					$args = array(
						'container'			=> 'ul',
						'theme_location' 	=> 'primary',
						'menu_class' 		=> 'nav-menu',
						'menu_id' 			=> 'primary-menu',
						'after' 			=> '<span></span>'
					);
					wp_nav_menu( $args );
				?>

				<button class="btn"><?php _e('Contact', 'layback'); ?></button>
			</nav>
		</div>
		<div class="scroll_line"></div>
	</div>