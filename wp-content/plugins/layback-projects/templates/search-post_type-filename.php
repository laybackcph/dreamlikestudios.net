<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div class="container">

			<?php while ( have_posts() ) : the_post(); ?>

				<a href="<?php the_permalink(); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail(); ?>
					<?php endif; ?>

					<h1 class="search-post-title"><?php the_title(); ?></h1>

					<div class="excerpt"><?php the_excerpt(); ?></div>

				</a>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

<?php get_footer(); ?>