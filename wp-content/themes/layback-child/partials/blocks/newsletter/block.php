<?php

	add_action('acf/init', 'lb_register_newsletter');
	function lb_register_newsletter()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Newsletter', 'layback');
	    	$description 			= __('Newsletter block', 'layback');
	    	$tags 					=	array('Newsletter');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'newsletter_block_render_callback';

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

	function newsletter_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$image = get_field('image');
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			<div class="inner">
				<?php if($image): ?>
					<img src="<?php echo $image['url']; ?>" alt="newsletter">
				<?php endif; ?>

				<form action="/">
					<h3><?php _e('Subscribe to our newsletter and get', 'layback'); ?> <span class="colored"><?php _e('Special discounts', 'layback'); ?></span></h3>
					<input type="email" placeholder="<?php _e('Enter your email', 'layback'); ?>">
					<button><i class="fas fa-chevron-right"></i></button>
				</form>
			</div>
	    </div>
    <?php }