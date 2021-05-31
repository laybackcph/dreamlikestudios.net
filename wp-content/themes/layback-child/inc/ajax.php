<?php
	
	// add_action('wp_ajax_myajax', 'myajax');
	// add_action('wp_ajax_nopriv_myajax', 'myajax');
	function myajax()
	{
		//This is to show how to make an ajax-function.
	
		echo json_encode(array(
			'success'	=> true,
		));
		die();
	}