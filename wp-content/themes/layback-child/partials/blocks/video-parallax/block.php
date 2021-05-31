<?php

	add_action('acf/init', 'lb_register_video_parallax');
	function lb_register_video_parallax()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Video parallax', 'layback');
	    	$description 			= __('Video parallax block', 'layback');
	    	$tags 					=	array('Video parallax');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'video_parallax_block_render_callback';

	        // register a testimonial block.
	        acf_register_block_type(array(
	            'name'              => basename(__DIR__),
				'title'             => $title,
				'description'       => $description,
				'keywords'			=> $tags,
				'icon'              => '',
				'category'          => 'layback',
//					'post_types' 		=> array('post', 'page'),
				'supports' 			=> array(
					'mode'			=> 'auto',
					'align'			=> $align,
				),
				'render_callback'   => $render,
				'enqueue_style' 	=> get_stylesheet_directory_uri() . '/partials/blocks/' . basename(__DIR__) . '/style.css',
				'enqueue_script' 	=> get_stylesheet_directory_uri() . '/partials/blocks/' . basename(__DIR__) . '/script.js',
	        ));
	    }
	}

	function video_parallax_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
	{

		/* Add all variables in the top
		-------------------------------------------------- */

		$block_name			= substr($block['name'], 4);
		$block_id 			= $block['id'];
		$block_title 		= strtolower(str_replace(" ","_",$block['title']));
		$block_filename 	= pathinfo(__FILE__, PATHINFO_FILENAME);
		
		if( !empty($block['align']) ) {
			$block_align 	= $block['align'];
		}

	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			<video src="https://local.dreamliketest.dk/wp-content/uploads/2021/05/Video-Hero-1.m4v" muted></video>
			<img src="./wp-content/themes/layback-child/partials/blocks/video-parallax/cave.png" alt="cave">
	    </div>
    
    <?php }