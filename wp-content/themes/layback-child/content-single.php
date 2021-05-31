<div id="post" <?php post_class('container'); ?>>
	
	<h1 class="post-title"><?php the_title(); ?></h1>
	
	<?php if ( has_post_thumbnail() ) : ?>
	    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	        <?php the_post_thumbnail(); ?>
	    </a>
	<?php endif; ?>

	<div class="post-date"><?php echo get_the_date(); ?></div>
	
	<div class="post-content">
		
		<?php the_content(); ?>
	
	</div>

</div>