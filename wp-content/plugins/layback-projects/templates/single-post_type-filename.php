<?php get_header(); ?>

<div class="single-event">
	
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 


			if ( has_blocks( $post->post_content ) ) {
			    $blocks = parse_blocks( $post->post_content );
			    // print'<pre>';print_r($blocks);print'</pre>';
			    foreach( $blocks as $block ) {
			    	if($block['blockName'] == 'acf/hero')
			    	{
			        	echo render_block( $block );
			    	}
			    	else
			    	{
			    		continue;
			    	}
			    }
			}

			?>
			<div class="container inner">


				<!-- 	<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?> -->

					<!-- <h1 class="single-post-title"><?php the_title(); ?></h1> -->

					<div class="content">
						

						<?php 

						if ( has_blocks( $post->post_content ) ) {
						    $blocks = parse_blocks( $post->post_content );
						    // print'<pre>';print_r($blocks);print'</pre>';
						    foreach( $blocks as $block ) {
						    	if($block['blockName'] != 'acf/hero')
						    	{
						        	echo render_block( $block );
						    	}
						    	else
						    	{
						    		continue;
						    	}
						    }
						}

						?>

					</div>


			</div>

		<?php endwhile; ?>	
	<?php endif; ?>
	
</div>

<?php get_footer(); ?>