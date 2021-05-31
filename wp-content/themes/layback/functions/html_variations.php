<?php
	function lb_attributes($attribute_name, $options, $term_name = '', $echo = true){
		ob_start();
		global $product;
		echo '<div class="'.sanitize_title( $attribute_name ).'-wrap variation-wrap" data-attribute_name="'.sanitize_title( $attribute_name ).'">';
		
		$variation_ids = $product->get_children(); // Get product variation IDs
		$stocks = array();

		foreach( $variation_ids as $variation_id ){
			$variation = wc_get_product($variation_id);

			$vdata = $variation->get_data();

			foreach($vdata['attributes'] as $vattr => $vattr_val){
				$stocks[$vattr][$vattr_val] = ( $variation->is_in_stock() ) ? '1' : '0';
			}
		}

		foreach($options as $option){
			$term = get_term_by('slug', $option, $attribute_name);
			$style = '';
			$class = '';

			$title = (!empty($term)) ? $term->name : $option;

			if($term_name != ''){
				if(!empty(get_field($term_name, $attribute_name.'_'.$term->term_id))){
					$style = 'style="background-color:'.get_field($term_name, $attribute_name.'_'.$term->term_id).';"';
					$class = ' has_color';
				}
			}

			$in_stock = $stocks[strtolower($attribute_name)][$option];
	?>
		<span class="variation-item <?php echo (!$in_stock) ? 'sold-out' : ''; echo $class; ?>" data-rasmus="<?php echo $term_name; ?>" <?php echo $style; ?> data-option="<?php echo $option; ?>"><?php echo $title; ?></span>
	<?php
		}
		echo '</div>';

?>
<style>
	select#<?php echo sanitize_title( $attribute_name ); ?> + .reset_variations,
	select#<?php echo sanitize_title( $attribute_name ); ?> { display:none !important; }
</style>
<?php

		$html = ob_get_clean();

		if($echo){
			echo $html;
		} else {
			return $html;
		}
	}
?>