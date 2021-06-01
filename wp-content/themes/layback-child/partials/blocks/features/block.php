<?php

	add_action('acf/init', 'lb_register_features');
	function lb_register_features()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Features', 'layback');
	    	$description 			= __('Features block', 'layback');
	    	$tags 					=	array('Feature', 'Features');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'features_block_render_callback';

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

	function features_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$highlights 		= get_field('highlights', 'options');



	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			
			<h2><span class="dots"></span><?php echo 'Lorem ipsum?!'; ?></h2>

			<div class="features">
				<?php
					if( have_rows('highlights', 'option') ) :
						while ( have_rows('highlights', 'option') ) : the_row(); 
							$icon_fa	= get_sub_field('icon_fa');
							$icon		= get_sub_field('icon');
							$title		= get_sub_field('title');
							?>
								<div class="feature">
									<div class="icon">
										<?php if($icon_fa) : ?>
											<i class="<?php echo $icon_fa; ?>"></i>
										<?php elseif ($icon) :?>
											<img src="<?php echo $icon['url']; ?>" alt="">
										<?php endif; ?>
									</div>
									<h5><?php echo $title; ?></h5>
								</div>
						<?php 
					endwhile;
				endif; 
			?>
			</div>
	    </div>
    
    <?php }