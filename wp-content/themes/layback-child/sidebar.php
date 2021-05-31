<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div id="sidebar" class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
		<div id="widget-area" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div>
	</div>
<?php endif; ?>