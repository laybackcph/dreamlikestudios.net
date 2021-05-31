<?php
if(class_exists( 'FrmFormAction' ))
{


	class FormidableUTMCampaign extends FrmFormAction 
	{

		function __construct() 
		{
			$action_ops = array(
			    'classes'   => 'dashicons dashicons-format-aside',
			    'limit'     => 99,
			    'active'    => true,
			    'priority'  => 50,
			);
			
		    $this->FrmFormAction('formidable_utmcampaign_action', __('UTM Campaign Action', 'formidable-klaviyo'), $action_ops);
		}

		function form($form_action, $args = array()) 
		{
		    extract($args);
		    $action_control 			= $this;
		    $iFormID 					= $action_control->form_id;
		    $aFormidableFormFields 		= $args['values']['fields'];
		    $sFormidableFormName		= $args['form']->name;
			$aPostContent 				= $form_action->post_content;
			?>
				<div>
				</div>
				    <table class="form-table frm-no-margin">
					    <thead>
					    	<tr>
					    		<td>
									<strong><?php echo __('Formidable Field', 'formidable-klaviyo'); ?></strong>
					    		</td>
					    		<td>
					    			<strong><?php echo __('UTM Name', 'formidable-klaviyo'); ?></strong>
					    		</td>
					       		<td>
					    		</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<?php
					    		foreach($aFormidableFormFields as $iFieldKey => $oField)
					    		{
					    			if($oField['type'] == 'hidden')
					    			{
						    			if(isset($aPostContent[$oField['field_key']]))
						   				{
						   					$sFieldKeyValue = $aPostContent[$oField['field_key']];
						   				}
						   				else
						   				{
						   					$sFieldKeyValue = "0";
						   				}
						    			?>
									    	<tr>
									    		<td>
									    			<?php echo '<strong>' . $oField['name'] . "</strong> (ID: ".$oField['field_key'].")"; ?>
									    		</td>
									    		<td>
									    			<select class="select--formidable-utmdata" name="<?php echo esc_attr($action_control->get_field_name($oField['field_key'])); ?>">
									    				<option value="0"><?php echo __('Please Choose...', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_source') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 	value="utm_source"><?php echo __('utm_source', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_campaign') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 	value="utm_campaign"><?php echo __('utm_campaign', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_medium') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 	value="utm_medium"><?php echo __('utm_medium', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_term') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 		value="utm_term"><?php echo __('utm_term', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_content') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 	value="utm_content"><?php echo __('utm_content', 'formidable-klaviyo'); ?></option>
									    				<option <?php if($sFieldKeyValue === 'utm_pages') { echo 'selected="selected"'; } ?> class="option--formidable-utmdata" 	value="utm_pages"><?php echo __('utm_pages', 'formidable-klaviyo'); ?></option>
									    			</select>
									    		</td>
									    	</tr>
						    			<?php
					    			}
					    		}
					    	?>
					    </tbody>
				    </table>
				    <script>
				   //  jQuery(document).ready(function() 
				   //  {
				   //  	jQuery('.select--formidable-utmdata').on('change', function()
				   //  	{
				   //  		jQuery('.option--formidable-utmdata').attr('disabled', false);
							// jQuery('.select--formidable-utmdata').each(function()
							// {
							// 	sValue = jQuery(this).val();
							// 	oDisableThis = jQuery('.option--formidable-utmdata[value="'+sValue+'"');
							// 	jQuery(oDisableThis).blur();
							// })
				   //  	});
				   //  });
				    </script>
			<?php 
		}


		
		/**
		* Add the default values for your options here
		*/
		function get_defaults() 
		{
		    return array(
		        // 'template_name' => '',
		        // 'my_content'=> '',
		    );
		}
	}
}