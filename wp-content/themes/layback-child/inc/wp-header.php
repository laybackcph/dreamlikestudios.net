<?php 

	// Add scripts to wp_head()
	add_action( 'wp_head', 'lb_script_and_tags_to_wp_head' );
	function lb_script_and_tags_to_wp_head()
	{
		$http = isset($_SERVER["HTTPS"]) ? 'https' : 'http';

?>
<script type="text/javascript">var ajaxurl = '<?php echo strtolower($http).'://'.$_SERVER['HTTP_HOST'].'/wp-admin/admin-ajax.php';  ?>';</script>
<?php
	}
	