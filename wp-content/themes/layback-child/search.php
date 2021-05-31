<?php get_header(); ?>
	
<?php if ( have_posts() ) : ?>
	<div id="primary" class="content-area">
		<div class="container">
			<div class="row">

				<div class="col-xs col-sm col-md col-lg">
					<main id="main" class="site-main" role="main">
						
						<?php while ( have_posts() ) : the_post(); ?>
							<h1 class="page-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h1>

							<?php the_excerpt(); ?>
							
							<a class="readmore" href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'layback' ); ?></a>
							<hr />

						<?php endwhile; ?>

					</main>
				</div>
				
				<?php get_sidebar(); ?>

			</div>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>