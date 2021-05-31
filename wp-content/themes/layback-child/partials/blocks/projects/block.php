<?php

	add_action('acf/init', 'lb_register_projects');
	function lb_register_projects()
	{

	    // check function exists.
	    if( function_exists('acf_register_block_type') )
	    {

	    	$title 					= __('Projects', 'layback');
	    	$description 			= __('Projects block', 'layback');
	    	$tags 					=	array('Project', 'Projects');
	    	$align 					= array('wide', 'full');
	    	$render 				= 'projects_block_render_callback';

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

	function projects_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 )
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
		$projects		= get_field('projects');

		if(!$projects) 
		{
			$args =  array(
				'posts_per_page' => -1,
				'post_type' => 'project',
			);

			$projects = get_posts($args);
		}

	  ?>
	
	    <div id="<?php echo $block_id; ?>" class="lb-block <?php if( !empty($block_align) ) { echo 'align-' . $block_align; } ?> block-<?php echo $block_name; ?>">
	    	<h2><span class="dots"></span><?php _e('Our projects', 'layback'); ?></h2>
			<div id="our-projects">

				<?php foreach ($projects as $project) : ?>
					<div class="project" style="background-image: url(<?php echo get_the_post_thumbnail_url($project->ID); ?>);">
						<div class="inner">
							<h3><?php echo get_the_title($project->ID); ?></h3>
							<span><?php echo get_the_excerpt($project->ID); ?></span>
						</div>
					</div>				
				<?php endforeach; ?>
			</div>
	    </div>
    
    <?php }