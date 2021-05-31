<?php

	add_action('acf/init', 'lb_register_faq');
	function lb_register_faq()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('FAQ', 'layback');
	    	$description 			= __('FAQ block', 'layback');
	    	$tags 					=	array('FAQ', 'Questions', 'Answers');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'faq_block_render_callback';

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

	function faq_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

			<ul class="accordion">
			  	<li>
			  		
			    	<div class="accordion--headline">
			    		<span class="accordion--close"></span>
				    	Accordion #1
				    </div>
			    	<div class="accordion--content">Accordion content is here</div>
			  	</li>
			  	<li>
			    	<div class="accordion--headline">
			    		<span class="accordion--close"></span>
				    	Accordion #2
				    </div>
			    	<div class="accordion--content">Accordion content is here</div>
			  	</li>
			</ul>
	    </div>
    
    <?php }