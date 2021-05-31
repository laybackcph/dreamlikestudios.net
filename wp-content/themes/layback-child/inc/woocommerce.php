<?php

	
	/* WooCommerce support
	------------------------------------------------------------------ */

	add_action( 'after_setup_theme', 'lb_add_woocommerce_support' );
	function lb_add_woocommerce_support() {
	    
	    add_theme_support( 'woocommerce' );

	    // Support for galleri in W3.0 and newer
	    add_theme_support( 'wc-product-gallery-zoom' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );

	}


	/* WooCommerce admin notice
	------------------------------------------------------------------ */

	add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

	
	/* WooCommerce styling
	------------------------------------------------------------------ */

	add_filter( 'woocommerce_enqueue_styles', 'layback_dequeue_styles' );
	function layback_dequeue_styles( $enqueue_styles ) {
		unset( $enqueue_styles['woocommerce-general'] );
		unset( $enqueue_styles['woocommerce-layout'] );
		// unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
		return $enqueue_styles;
	}

	
	/* WooCommerce products per page
	------------------------------------------------------------------ */
	
	add_filter( 'loop_shop_per_page', 'lb_products_per_page', 20 );
	if(!function_exists('lb_products_per_page'))
	{
		function lb_products_per_page() {
			return 9;
		}
	}


	/* WooCommerce remove actions
	------------------------------------------------------------------ */
	
	// add_action( 'init', 'lb_remove_woocommerce_functions' );
	function lb_remove_woocommerce_functions()
	{

		/* General
		------------------------------------------------------------------ */

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		

		/* WooCommerve archive
		------------------------------------------------------------------ */

		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0 );
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0 );

	}


	/* WooCommerve dynamic cart
	------------------------------------------------------------------ */

	// add_filter('add_to_cart_fragments', 'lb_woocommerce_header_add_to_cart_fragment');
	function lb_woocommerce_header_add_to_cart_fragment( $fragments )
	{
		ob_start();
		$cart_items = WC()->cart->get_cart_contents_count();
		echo '<a class="header-cart" href="' . get_permalink( wc_get_page_id( 'cart' ) ) . '">';
			echo '<i class="fas fa-shopping-cart"></i>';
			
			if($cart_items == 0){
				echo get_the_title(wc_get_page_id( 'cart' )); 
			}else{
				echo '<span class="cart-items">' . WC()->cart->get_total() . '</span>';
			}
		echo '</a>';
		
		$fragments['.header-cart'] = ob_get_clean();
		return $fragments;
	}


	/* WooCommerve checkout
	------------------------------------------------------------------ */

	// add_filter( 'woocommerce_checkout_fields' , 'lb_checkout_billing_fields', 20, 1 );
	function lb_checkout_billing_fields( $fields )
	{
		
		$domain = 'layback';
			
		$fields['billing']['billing_phone']['placeholder']		= __( 'Phone', $domain );
		$fields['billing']['billing_email']['placeholder']		= __( 'Email', $domain );
		$fields['billing']['billing_company']['placeholder']	= __( 'Company', $domain );

		// Change class
		$fields['billing']['billing_company']['class']			= array('form-row-wide');

		$fields['billing']['billing_postcode']['class']			= array('form-row-first');
		$fields['billing']['billing_city']['class']				= array('form-row-last');
		
		$fields['billing']['billing_phone']['class']			= array('form-row-first');
		$fields['billing']['billing_email']['class']			= array('form-row-last');

		return $fields;

	}