var sAjaxURL = "";

jQuery(document).ready(function()
{
	jQuery('.gff_fields_count').val(jQuery('.gff_line_wrapper').length);

	jQuery(document).on('click', '.gff_delete', function()
	{
		var iFieldCount = parseInt(jQuery('.gff_fields_count').val());
		if(iFieldCount > 1 && jQuery('.gff_line_wrapper').length > 1)
		{
			jQuery('.gff_form_wrapper').last().remove();	
			jQuery('.gff_fields_count').val(jQuery('.gff_line_wrapper').length);
		}
	});
 
	jQuery('.gff_add').on('click', function()
	{
		var iFieldCount = parseInt(jQuery('.gff_fields_count').val());
		jQuery('.gff_fields_count').val(jQuery('.gff_line_wrapper').length+5);
		var fieldsHtmL = '<div class="gff_form_wrapper">'+
							'<input class="gff_form_name" name="general_options[formname_'+(iFieldCount)+']" placeholder="Form Name" value="">'+
							'</br>'+
							'<input class="gff_pages_visited" name="general_options[pages_visited_'+(iFieldCount)+']" placeholder="Field Key for visited pages" value="">'+
							'<div class="gff_line_wrapper">'+
							'<input type="text" class="gff_fieldid textinput" name="general_options[fieldid_'+(iFieldCount+1)+']" placeholder="Formidable Field Key">'+
							'<input type="text" class="gff_refname textinput" name="general_options[refname_'+(iFieldCount+1)+']" value="utm_source" placeholder="Paramenter Name">'+
							'</div>'+
							'<div class="gff_line_wrapper">'+
							'<input type="text" class="gff_fieldid textinput" name="general_options[fieldid_'+(iFieldCount+2)+']" placeholder="Formidable Field Key">'+
							'<input type="text" class="gff_refname textinput" name="general_options[refname_'+(iFieldCount+2)+']" value="utm_medium" placeholder="Paramenter Name">'+
							'</div>'+
							'<div class="gff_line_wrapper">'+
							'<input type="text" class="gff_fieldid textinput" name="general_options[fieldid_'+(iFieldCount+3)+']" placeholder="Formidable Field Key">'+
							'<input type="text" class="gff_refname textinput" name="general_options[refname_'+(iFieldCount+3)+']" value="utm_campaign" placeholder="Paramenter Name">'+
							'</div>'+
							'<div class="gff_line_wrapper">'+
							'<input type="text" class="gff_fieldid textinput" name="general_options[fieldid_'+(iFieldCount+4)+']" placeholder="Formidable Field Key">'+
							'<input type="text" class="gff_refname textinput" name="general_options[refname_'+(iFieldCount+4)+']" value="utm_term" placeholder="Paramenter Name">'+
							'</div>'+
							'<div class="gff_line_wrapper">'+
							'<input type="text" class="gff_fieldid textinput" name="general_options[fieldid_'+(iFieldCount+5)+']" placeholder="Formidable Field Key">'+
							'<input type="text" class="gff_refname textinput" name="general_options[refname_'+(iFieldCount+5)+']" value="utm_content" placeholder="Paramenter Name">'+
							'</div>'+
						'</div>';
		;
		jQuery('.gff_field_wrapper').append(fieldsHtmL);

	});
});