<?php

	if(!function_exists('lb_flush_rewrite_rules'))
	{
		
		// Flush rewrite rules
		add_action( 'after_switch_theme', 'lb_flush_rewrite_rules' );
		function lb_flush_rewrite_rules() {
			flush_rewrite_rules();
		}

	}

	add_action( 'init', 'lb_posttype_custom_partners' );
	function lb_posttype_custom_partners() {
	   
	   // Write these variables as all lowercase

		// Post variables
		$singular 				= __('Partner', 'layback');
		$multiple 				= __('Partners', 'layback');
		$description 			= __( 'Partner posttype', 'layback' );
		$single_slug 			= $singular;
		$archive_slug 			= $multiple;
		$menu_name 				= $multiple;
		$post_type_name 		= 'partner';

		// Category variables
		// $taxonomy_name 			= $post_type_name . '_cat';
		// $taxonomy_singular 		= __('category', 'layback');
		// $taxonomy_multiple 		= __('categories', 'layback');
		// $taxonomy_menuname 		= $taxonomy_multiple;
		// $taxonomy_slug 			= $taxonomy_singular;

		// Tag variables
		// $tag_name 				= $post_type_name . '_tag';
		// $tag_singular	 		= __('tag', 'layback');
		// $tag_multiple			= __('tags', 'layback');
		// $tag_menuname			= $tag_multiple;
		// $tag_slug				= $tag_singular;

		register_post_type(
			$post_type_name,
			array(
				'labels' 				=> array(
					'name'                 => ucfirst($multiple),
					'singular_name'        => ucfirst($singular),
					'all_items'            => __( 'All', 'layback' ).' '.$multiple,
					'add_new'              => __( 'Add new', 'layback' ),
					'add_new_item'         => __( 'Add new', 'layback' ).' '.$singular,
					'edit'                 => __( 'Edit', 'layback' ),
					'edit_item'            => __( 'Edit', 'layback' ).' '.$singular,
					'new_item'             => __( 'New', 'layback' ).' '.$singular,
					'view_item'            => __( 'View', 'layback' ).' '.$singular,
					'search_items'         => __( 'Search for', 'layback' ).' '.$singular,
					'not_found'            =>  __( 'Nothing found in the database', 'layback' ),
					'not_found_in_trash'   => __( 'The trash is empty', 'layback' ),
					'parent_item_colon'    => ''
				),
				'menu_name'             => ucfirst($menu_name),
				'description'			=> $description,
				'public'				=> true,
				'publicly_queryable'	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'query_var'				=> true,
				'menu_position'			=> null,
				'menu_icon'				=> 'dashicons-admin-post',
				'rewrite'				=> array(
					'slug'					=> $single_slug,
					'with_front'			=> false
				),
				'has_archive'			=> $archive_slug,
				'capability_type'		=> 'post',
				'hierarchical'			=> false,
				'show_in_rest'			=> true,
				'supports'				=> array(
					'title',
					// 'editor',
					'thumbnail',
					// 'page-attributes',
					// 'revisions',
					// 'author',
					// 'excerpt',
					// 'post-formats',
					// 'trackbacks',
					// 'custom-fields',
					// 'comments',
					// 'sticky'
				)
			)
		);

		// register_taxonomy(
		// 	$taxonomy_name,
		// 	array($post_type_name),
		// 	array(
		// 		'hierarchical'			=> true,
		// 		'labels'				=> array(
		// 			'name'					=> ucfirst($taxonomy_multiple),
		// 			'singular_name'			=> ucfirst($taxonomy_singular),
		// 			'menu_name'				=> ucfirst($taxonomy_menuname),
		// 			'search_items'			=> __( 'Search for', 'layback' ),
		// 			'all_items'				=> __( 'All', 'layback' ).' '.$taxonomy_multiple,
		// 			'parent_item'			=> __( 'Parent', 'layback') . ' ' . $taxonomy_singular,
		// 			'parent_item_colon'		=> __( 'Parent item:', 'layback'),
		// 			'edit_item'				=> __( 'Edit', 'layback' ) . ' ' . $taxonomy_singular,
		// 			'update_item'			=> __( 'Update', 'layback') . ' ' . $taxonomy_singular,
		// 			'add_new_item'			=> __( 'Add new', 'layback') . ' ' . $taxonomy_singular,
		// 			'new_item_name'			=> sprintf(__( 'New %s-name', 'layback' ), $taxonomy_singular),
		// 		),
		// 		'show_admin_column' 	=> true, 
		// 		'show_ui'				=> true,
		// 		'query_var'				=> true,
		// 		'rewrite'				=> array(
		// 			'slug'					=> $taxonomy_slug
		// 		),
		// 		'can_export'			=> true,
		// 		'show_in_rest'			=> true,
		// 		// 'rest_base'				=> $taxonomy,
		// 	)
		// );

		// register_taxonomy(
		// 	$tag_name, 
		// 	array($post_type_name),
		// 	array(
		// 		'hierarchical'			=> false,
		// 		'labels'				=> array(
		// 			'name'					=> ucfirst($tag_multiple),
		// 			'singular_name'			=> ucfirst($tag_singular),
		// 			'menu_name'				=> ucfirst($tag_menuname),
		// 			'search_items'			=> __( 'Search for', 'layback' ),
		// 			'all_items'				=> __( 'All', 'layback' ).' '.$tag_multiple,
		// 			'parent_item'			=> __( 'Parent', 'layback') . ' ' . $tag_singular,
		// 			'parent_item_colon'		=> __( 'Parent item:', 'layback'),
		// 			'edit_item'				=> __( 'Edit', 'layback' ) . ' ' . $tag_singular,
		// 			'update_item'			=> __( 'Update', 'layback') . ' ' . $tag_singular,
		// 			'add_new_item'			=> __( 'Add new', 'layback') . ' ' . $tag_singular,
		// 			'new_item_name'			=> sprintf(__( 'New %s-name', 'layback' ), $tag_singular),
		// 		),
		// 		'show_admin_column'		=> true,
		// 		'show_ui'				=> true,
		// 		'query_var'				=> true,
		// 		'show_in_rest'			=> true,
		// 	)
		// );

	}