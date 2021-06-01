<?php

	add_action('acf/init', 'lb_register_team');
	function lb_register_team()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('The team', 'layback');
	    	$description 			= __('The team block', 'layback');
	    	$tags 					=	array('the team', 'team');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'team_block_render_callback';

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

	function team_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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

		$title				= get_field('title');
		$aTeam				= get_field('team');

		if(!$aTeam) 
		{
			$args =  array(
				'posts_per_page' => -1,
				'post_type' => 'team',
			);

			$aTeam = get_posts($args);
		}
	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">	
			<h2><span class="dots"></span><?php echo $title; ?></h2>
			<div id="the-team">

				<?php foreach ($aTeam as $team) : ?>
					<div class="team-member">
						<img src="<?php echo get_the_post_thumbnail_url($team->ID); ?>" alt="member">
						<h3><?php echo get_the_title($team->ID); ?></h3>

						<?php 
							if( have_rows('social_media', $team->ID) ) :
								echo '<div class="social">';
									while ( have_rows('social_media', $team->ID) ) : the_row();
										$link = get_sub_field('link', $team->ID);
										$icon = get_sub_field('icon', $team->ID);
										if($link)
										{
											echo '<a href="'. $link['url'] .'" target="_blank"><i class="'. $icon .'"></i></a>';
										}
									endwhile;
								echo '</div>';
							endif;
						?>
					</div>				
				<?php endforeach; ?>
			</div>
	    </div>
    <?php }