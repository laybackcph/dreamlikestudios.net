<?php

	/* Theme support for Gutenberg
	------------------------------------------------------------------ */
	
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support('editor-styles');
	// add_theme_support('disable-custom-font-sizes');
	add_theme_support('align-wide');
	
	/* Color palette in Gutenberg
	------------------------------------------------------------------ */

	add_theme_support( 'editor-color-palette',
		array(
			array(
				'name'  => __( 'Black', 'layback' ),
				'slug'  => 'black',
				'color' => '#000',
			),
			array(
				'name'  => __( 'Light gray', 'genesis-sample' ),
				'slug'  => 'light-gray',
				'color'	=> '#f5f5f5',
			),
			array(
				'name'  => __( 'Medium gray', 'genesis-sample' ),
				'slug'  => 'medium-gray',
				'color' => '#999',
			),
			array(
				'name'  => __( 'Dark gray', 'genesis-sample' ),
				'slug'  => 'dark-gray',
				'color' => '#333',
			),
			array(
				'name'  => __( 'White', 'layback' ),
				'slug'  => 'white',
				'color' => '#fff',
			)
		)
	);

	/* Add colors to Iris
	------------------------------------------------------------------ */

	function lb_get_gutenberg_colors()
	{
		
		// get the colors
	    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

		// bail if there aren't any colors found
		if ( !$color_palette )
			return;

		// output begins
		ob_start();

		// output the names in a string
		echo '[';
			foreach ( $color_palette as $color ) {
				echo "'" . $color['color'] . "', ";
			}
		echo ']';
	    
	    return ob_get_clean();

	}

	/* Add colors to Iris
	------------------------------------------------------------------ */

	add_action( 'acf/input/admin_footer', 'lb_gutenberg_sections_register_acf_color_palette' );
	function lb_gutenberg_sections_register_acf_color_palette()
	{

	    $color_palette = lb_get_gutenberg_colors();
	    if ( !$color_palette )
	        return;
	    
	    ?>
	    <script type="text/javascript">
	        (function( $ ) {
	            acf.add_filter( 'color_picker_args', function( args, $field ){
	                // add the hexadecimal codes here for the colors you want to appear as swatches
	                args.palettes = <?php echo $color_palette; ?>
	                // return colors
	                return args;
	            });
	        })(jQuery);
	    </script>
	    <?php
	}

	/* Font sizes in Gutenberg
	------------------------------------------------------------------ */

	add_theme_support( 'editor-font-sizes', array(
	    array(
	        'name' => __( 'Small', 'themeLangDomain' ),
	        'size' => 12,
	        'slug' => 'small'
	    ),
	    array(
	        'name' => __( 'Normal', 'themeLangDomain' ),
	        'size' => 16,
	        'slug' => 'normal'
	    ),
	    array(
	        'name' => __( 'Large', 'themeLangDomain' ),
	        'size' => 36,
	        'slug' => 'large'
	    ),
	    array(
	        'name' => __( 'Huge', 'themeLangDomain' ),
	        'size' => 50,
	        'slug' => 'huge'
	    )
	) );