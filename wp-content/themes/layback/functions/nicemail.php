<?php
	//Split up a phonenumber to look nice
	function nicemail($number, $link = false, $tag = false, $print = false){
		$number = str_replace(' ', '', $number);

		$fullnumber = str_replace(' ', '', $number);

		if(!$print){
			if($link){
				if(!$tag){
					echo '<a href="mailto:'.$fullnumber.'">'.$fullnumber.'</a>';
				} else {
					if(is_string($tag)){
						echo '<a href="mailto:'.$fullnumber.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa mail\', eventAction: \''.$tag.'\', eventLabel: \'mail\'});">'.$fullnumber.'</a>';
					} else {
						echo '<a href="mailto:'.$fullnumber.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa mail\', eventAction: \''.get_the_title().'\', eventLabel: \'mail\'});">'.$fullnumber.'</a>';
					}
				}
			} else {
				echo $fullnumber;
			}
		} else {
			if($link){
				if(!$tag){
					return '<a href="mailto:'.$fullnumber.'">'.$fullnumber.'</a>';
				} else {
					if(is_string($tag)){
						return '<a href="mailto:'.$fullnumber.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa mail\', eventAction: \''.$tag.'\', eventLabel: \'mail\'});">'.$fullnumber.'</a>';
					} else {
						return '<a href="mailto:'.$fullnumber.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa mail\', eventAction: \''.get_the_title().'\', eventLabel: \'mail\'});">'.$fullnumber.'</a>';
					}
				}
			} else {
				return $fullnumber;
			}
		}
	}

	function nicemail_shortcode($atts){
		$atts = shortcode_atts( array(
			'mail' => get_field('mail', 'option'),
			'link' => false,
			'tag' => false,
		), $atts, 'mail' );

		return nicemail($atts['mail'], $atts['link'], $atts['tag'], true);
	}
	add_shortcode('mail', 'nicemail_shortcode');