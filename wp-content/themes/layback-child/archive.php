<?php get_header(); ?>
	
<?php if ( have_posts() ) : ?>
	<div class="container">
		<div class="row">
			<div class="col-xs col-sm col-md col-lg">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>
					<h3 class="page-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>