<?php get_header(); ?>

<?php 





$post_id = 173;
$post = get_post( $post_id ); 

if ( has_blocks( $post->post_content ) ) {
    $blocks = parse_blocks( $post->post_content );
    // print'<pre>';print_r($blocks);print'</pre>';
    foreach( $blocks as $block ) {
        echo render_block( $block );
    }
}


?>

<div class="archive-events">
	

	<?php if ( have_posts() ) : ?>

		<div class="container">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php 

				if(get_field('event_type', $post) == 'race')
				{
					$selectedVehicle	= get_field('display_vehicle_selected_vehicle');
					if ( has_blocks( $post->post_content ) ) {
					    $blocks = parse_blocks( $post->post_content );
					    $selectedVehicleID = 0;
					    foreach( $blocks as $block ) {
					    	if($block['blockName'] == 'acf/select-display-vehicle')
					    	{

					    		$selectedVehicleID = $block['attrs']['data']['display_vehicle_selected_vehicle'][0];
					    		$driverName = $block['attrs']['data']['driver_name'];
					    		$hasVehicle = true;
					    	}
					    	else
					    	{
					    		$driverName = '';
					    		$hasVehicle = false;
					    	}
					    }
					}

					$vehiclePost = get_post($selectedVehicleID);
				}

				?>

				<div class="event_item">
					
					<div class="event_title">
						<div class="loc">
							<span class="city"><?php echo get_field('event_location_city') ? get_field('event_location_city').', ' : ''; ?></span>
							<span class="country"><?php echo get_field('event_location_country') ? get_field('event_location_country') : ''; ?></span>
						</div>
						<h1 class="archive-post-title"><?php the_title(); ?></h1>
					</div>

					<div class="event_item_inner">
						<?php if(get_field('event_type', $post) == 'race') : ?>
						<div class="left">
							<div class="map_img" style="background-image: url(<?php if(get_the_post_thumbnail_url()) { echo get_the_post_thumbnail_url(); } else { echo 'https://c0.wallpaperflare.com/preview/629/652/934/car-brake-caliper-italian.jpg'; } ?>);">
								<div class="map_img_overlay">
									<div class="vehicle_img">
										<?php if(get_the_post_thumbnail_url($vehiclePost) && $hasVehicle) : ?>
											<img src="<?php echo get_the_post_thumbnail_url($vehiclePost);?>" class="vehicle">
										<?php else : ?>
											<img src="https://websetnet.net/wp-content/uploads/2019/02/default.png" class="missing">
										<?php endif; ?>
									</div>
									<div class="vehicle_title">
										<div class="brand"><?php echo get_field('vehicle_manufacturer', $vehiclePost); ?></div>
										<div class="spacer"></div>
										<div class="model"><?php echo get_field('vehicle_model', $vehiclePost); ?></div>
									</div>
									<div class="driver_name"><?php echo $driverName; ?></div>
									<div class="blur"></div>
								</div>
							</div>
						</div>
						<?php else : ?>
							<div class="left">
								<div class="map_img" style="background-image: url(<?php if(get_the_post_thumbnail_url()) { echo get_the_post_thumbnail_url(); } else { echo 'https://c0.wallpaperflare.com/preview/629/652/934/car-brake-caliper-italian.jpg'; } ?>);">									
								</div>
							</div>
						<?php endif; ?>
						<div class="right">
							<div class="description">
								<?php the_excerpt(); ?>
							</div>
							<a href="<?php the_permalink(); ?>" class="btn"><?php _e('View Event', 'layback'); ?></a>
						</div>
						
					</div>


				</div>

			<?php endwhile; ?>

		</div>

	<?php endif; ?>

</div>

<?php get_footer(); ?>