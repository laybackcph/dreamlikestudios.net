<?php

	add_action('acf/init', 'lb_register_process');
	function lb_register_process()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('The process', 'layback');
	    	$description 			= __('Process block', 'layback');
	    	$tags 					=	array('the process', 'process');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'process_block_render_callback';

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

	function process_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$title 				= get_field('title');
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			<h2><span class="dots"></span><?php echo $title; ?></h2>
			
			<div class="process">
				<?php 
					if( have_rows('process_steps') ) :
						while ( have_rows('process_steps') ) : the_row(); 
							$title 			= get_sub_field('title');
							$description 	= get_sub_field('description');
							$procent 		= get_sub_field('procent');
							$icon 			= get_sub_field('icon');
							?>
								<div class="process-single">				
									<div class="icon">										
										<svg class="circle-chart" viewbox="0 0 33.83098862 33.83098862" xmlns="http://www.w3.org/2000/svg">
										  <circle class="circle-chart__background" stroke-width="2" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
										  <circle class="circle-chart__circle" stroke-width="2" stroke-dasharray="<?php echo $procent; ?>,100" stroke-linecap="round" fill="none" cx="16.91549431" cy="16.91549431" r="15.91549431" />
										</svg>
										<i class="<?php echo $icon; ?>"></i>
									</div>

									<h4><?php echo $title; ?></h4>
									<p><?php echo $description; ?></p>
								</div>
							<?php 
						endwhile;
					endif;
				?>
			</div>
	    </div>
    <?php }