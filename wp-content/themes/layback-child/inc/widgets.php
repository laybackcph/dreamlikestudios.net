<?php
	
	/* Register widgets
	------------------------------------------------------------------ */

	add_action( 'widgets_init', 'lb_widgets_init' );
	function lb_widgets_init()
	{

		register_sidebar( array(
			'name'          => __( 'Sidebar', 'layback' ),
			'id'            => 'sidebar',
			'description'   => __( 'Place your widgets here', 'layback' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer widgets', 'layback' ),
			'id'            => 'footer',
			'description'   => __( 'Place your widgets here', 'layback' ),
			'before_widget' => '<div id="%1$s" class="col-xs-12 col-sm-12 col-md col-lg widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

	}