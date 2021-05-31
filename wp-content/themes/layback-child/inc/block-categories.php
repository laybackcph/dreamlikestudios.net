<?php

	// adding custom layback category in gutenberg
	add_filter( 'block_categories', 'layback_block_category', 10, 2);
	function layback_block_category( $categories, $post ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'layback',
					'title' => __( 'Layback Blocks', 'layback' ),
				),
			)
		);
	}