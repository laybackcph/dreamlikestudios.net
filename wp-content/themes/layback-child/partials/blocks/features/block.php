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

	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			
			<h2><span class="dots"></span><?php echo 'Lorem ipsum?!'; ?></h2>

			<div class="features">
				<div class="feature">
					<div class="icon">
						<i class="fab fa-html5"></i>
					</div>
					<h5>HTML5</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fab fa-css3-alt"></i>
					</div>
					<h5>CSS3</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fab fa-bootstrap"></i>
					</div>
					<h5>Bootstrap</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fad fa-font-case"></i>
					</div>
					<h5>Google Fonts</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fas fa-cogs"></i>
					</div>
					<h5>Lorem</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fal fa-envelope-open-text"></i>
					</div>
					<h5>Ipsum</h5>
				</div>
				<div class="feature">
					<div class="icon">
						<i class="fal fa-user-headset"></i>
					</div>
					<h5>Support 24/7</h5>
				</div>
			</div>
	    </div>
    
    <?php }