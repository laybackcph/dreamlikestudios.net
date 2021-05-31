jQuery(document).ready(function(){
	variationActivated();
	
	jQuery(document).on('click', '.variation-item:not(.sold-out)', function(){
		var $this = jQuery(this),
			option = $this.data('option'),
			$parent = jQuery(this).closest('.variation-wrap'),
			attr = $parent.data('attribute_name');

		if(!$this.hasClass('active')){
			$parent.children('.variation-item').removeClass('active');
			$this.addClass('active');

			jQuery('#' + attr).val(option);
			jQuery('#' + attr).trigger('change');
		} else {
			if(jQuery('.reset_variations').size() > 0){
				$this.removeClass('active');
				jQuery('.variation-wrap.activated').removeClass('activated');
				jQuery('.reset_variations').trigger('click');
			}
		}
		
		if($parent.find('.variation-item.active').size() > 0){
			$parent.addClass('activated');
		} else {
			$parent.removeClass('activated');
		}
	});
});

function variationActivated(){
	if(jQuery('.variation-item').size() > 0) {
		jQuery('.variations select').each(function(){
			var id = jQuery(this).attr('id');
			var val = jQuery(this).val();

			jQuery('.' + id + '-wrap span[data-option="' + val + '"]').addClass('active');
			
			if(jQuery('.' + id + '-wrap span.active').size() > 0) {
				jQuery('.' + id + '-wrap').addClass('activated')
			}
		});
	}
}