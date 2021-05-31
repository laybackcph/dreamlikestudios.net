<?php
	//Split up a phonenumber to look nice
	function nicephone($number, $split = 2, $link = false, $tag = false, $print = false){
		$numberstart = '';
		if(substr($number, 0, 1) == '+'){
			$numberstart = substr($number, 0, 3).' ';
			$number = substr($number, 3);
		}

		$number = str_replace(' ', '', $number);

		$fullnumber_nosplit_link = str_replace(' ', '', '+45'.$number);
		$fullnumber_nosplit = str_replace(' ', '', $numberstart.$number);
		$fullnumber = trim($numberstart.chunk_split($number, $split, ' '));

		if(!$print){
			if($link){
				if(!$tag){
					echo '<a href="tel:'.$fullnumber_nosplit_link.'">'.$fullnumber.'</a>';
				} else {
					if(is_string($tag)){
						echo '<a href="tel:'.$fullnumber_nosplit_link.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa tlf\', eventAction: \''.$tag.'\', eventLabel: \'TLF\'});">'.$fullnumber.'</a>';
					} else {
						echo '<a href="tel:'.$fullnumber_nosplit_link.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa tlf\', eventAction: \''.get_the_title().'\', eventLabel: \'TLF\'});">'.$fullnumber.'</a>';
					}
				}
			} else {
				echo $fullnumber;
			}
		} else {
			if($link){
				if(!$tag){
					return '<a href="tel:'.$fullnumber_nosplit_link.'">'.$fullnumber.'</a>';
				} else {
					if(is_string($tag)){
						return '<a href="tel:'.$fullnumber_nosplit_link.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa tlf\', eventAction: \''.$tag.'\', eventLabel: \'TLF\'});">'.$fullnumber.'</a>';
					} else {
						return '<a href="tel:'.$fullnumber_nosplit_link.'" onclick="ga(\'send\', \'event\', { eventCategory: \'Tryk paa tlf\', eventAction: \''.get_the_title().'\', eventLabel: \'TLF\'});">'.$fullnumber.'</a>';
					}
				}
			} else {
				return $fullnumber;
			}
		}
	}

	function nicephone_shortcode($atts){
		$atts = shortcode_atts( array(
			'num' => get_field('phone', 'option'),
			'split' => '2',
			'link' => false,
			'tag' => false,
		), $atts, 'telefon' );

		return nicephone($atts['num'], $atts['split'], $atts['link'], $atts['tag'], true);
	}
	add_shortcode('telefon', 'nicephone_shortcode');