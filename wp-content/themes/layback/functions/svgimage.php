<?php

	function scaled_image_path($attachment_id, $size = 'thumbnail') {
	    $file = get_attached_file($attachment_id, true);
	    if (empty($size) || $size === 'full') {
	        // for the original size get_attached_file is fine
	        return realpath($file);
	    }
	    if (! wp_attachment_is_image($attachment_id) ) {
	        return false; // the id is not referring to a media
	    }
	    $info = image_get_intermediate_size($attachment_id, $size);
	    if (!is_array($info) || ! isset($info['file'])) {
	        return false; // probably a bad size argument
	    }

	    return realpath(str_replace(wp_basename($file), $info['file'], $file));
	}


	function svgimage($image_id, $echo = true)
	{
		$image = wp_get_attachment_image( $image_id , 'full' );
		$imagetype = get_post_mime_type( $image_id );

		if(strpos($imagetype, 'svg') !== false)
		{

			$svglogo = scaled_image_path( $image_id , 'full' );
			readfile($svglogo);

		}
		else
		{
			if($echo)
			{
				echo $image;

			}else{
				return $image;
			}

		}

	}