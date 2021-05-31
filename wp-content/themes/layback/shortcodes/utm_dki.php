<?php

	/* UTM DKI shortcode
	------------------------------------------------------------------ */

	add_shortcode( 'lb_get', 'lb_get_parameter_shortcode' );
	function lb_get_parameter_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'fallback' => '',
			'get' => 'utm_dki',
		), $atts, 'lb_get' );

		$html = '';
		ob_start();

		if(isset($_GET[$atts['get']])){
			echo $_GET[$atts['get']];
		} else {
			echo $atts['fallback'];
		}

		$html = ob_get_clean();
		return $html;
	}