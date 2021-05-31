<div id="colophon" class="site-footer">

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
	</nav>

	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="socials">
		<?php
			$facebook	= get_theme_mod('layback_facebook'); 
			$instagram	= get_theme_mod('layback_instagram'); 
			$linkedin	= get_theme_mod('layback_linkedin'); 
			$twitter	= get_theme_mod('layback_twitter'); 
			$pinterest	= get_theme_mod('layback_pinterest');
			$youtube	= get_theme_mod('layback_youtube');
			$twitch		= get_theme_mod('layback_twitch');

			if($facebook)
			{
				echo '<a href="'. $facebook .'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
			}

			if($instagram)
			{
				echo '<a href="'. $instagram .'" target="_blank"><i class="fab fa-instagram"></i></a>';
			}

			if($linkedin)
			{
				echo '<a href="'. $linkedin .'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
			}

			if($twitter)
			{
				echo '<a href="'. $twitter .'" target="_blank"><i class="fab fa-twitter"></i></a>';
			}
			
			if($pinterest)
			{
				echo '<a href="'. $pinterest .'" target="_blank"><i class="fab fa-pinterest-p"></i></a>';
			}
			
			if($youtube)
			{
				echo '<a href="'. $youtube .'" target="_blank"><i class="fab fa-youtube"></i></a>';
			}
			
			if($twitch)
			{
				echo '<a href="'. $twitch .'" target="_blank"><i class="fab fa-twitch"></i></a>';
			}
		?>
	</div>

	<div class="copyright">Copyright &copy; <?php get_theme_mod('company'); ?> <?php echo date('Y'); ?> <?php _e( 'All rights reserved', 'layback' ); ?></div>

</div>

<?php wp_footer(); ?>

</body>
</html>