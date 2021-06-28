<?php

	add_action('acf/init', 'lb_register_contact_map');
	function lb_register_contact_map()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Contact & map', 'layback');
	    	$description 			= __('Contact & map in 1 block', 'layback');
	    	$tags 					=	array('Contact', 'map');
	    	$align 					= array('full');
	    	$render 				= 'contact_map_block_render_callback';

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

	function contact_map_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$small_headline 	= get_field('small_headline');
		$big_headline	 	= get_field('big_headline');
		$description	 	= get_field('description');
		$map			 	= get_field('map');
		$form_id			= get_field('form_id');
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">
			<div class="contact-form-map">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contact-form">
			    	<div class="form-wrapper">
				    	<h5><?php echo $small_headline; ?></h5>
				    	<h3><?php echo $big_headline; ?></h3>
				    	<p><?php echo $description; ?></p>
				    	<?php echo FrmFormsController::get_form_shortcode( array( 'id' => $form_id, 'title' => false, 'description' => false ) ); ?>
				    </div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 contact-map">
					<div class="title-wrapper">
						<h3><?php echo get_theme_mod('company'); ?></h3>
					</div>
					<?php echo $map; ?>
				</div>
			</div>
		</div>
    <?php }