<?php

	add_action('acf/init', 'lb_register_partners');
	function lb_register_partners()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Partners', 'layback');
	    	$description 			= __('Partners block', 'layback');
	    	$tags 					=	array('Partner', 'Partners');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'partners_block_render_callback';

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

	function partners_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$title			= get_field('title');
		$partners		= get_field('partners');

		if(!$partners) 
		{
			$args =  array(
				'posts_per_page' => -1,
				'post_type' => 'partner',
			);

			$partners = get_posts($args);
		}
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">
	    	<h2><span class="dots"></span><?php echo $title; ?></h2>
	    	
			<div id="partners">
				<?php foreach ($partners as $partner) : ?>
						<?php 
							$link 		= get_field('partner_link', $partner->ID);
							$thumbnail 	= get_the_post_thumbnail_url($partner->ID);

							if($link) :
								echo '<a href="'. $link['url'] .'" class="partner" target="_blank">';
							else :
								echo '<a class="partner">';
							endif;

								if($thumbnail) :
									echo '<img src="'. $thumbnail .'" alt="partner logo">';
								else :
									echo '<h4>'. $partner->post_title .'</h4>';
								endif; 

							echo '</a>';
						?>
				<?php endforeach; ?>
			</div>
	    </div>
    
    <?php }