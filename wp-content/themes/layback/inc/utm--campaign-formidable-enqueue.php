<?php
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if(is_plugin_active('formidable/formidable.php'))
    {
		//campaign formidable
		add_action('wp_enqueue_scripts', 'enqueue_formidable');	
		function enqueue_formidable()
		{
		    $oQueriedObject = get_queried_object();
	        if(!isset($oQueriedObject->ID) || empty($oQueriedObject->ID))
	        {
	            $iPostID = "Null";
	        }
	        else
	        {
	            $iPostID = $oQueriedObject->ID; 
	        }

	        $aParamsFrontend = array
	        (
	            'sAjaxURL'          => admin_url('admin-ajax.php'),
	            'aParaRef'          => get_acf_option_fieldkeys(),
	            'aVisitedPagesKey'  => get_acf_option_visitedpages(),
	            'iPostID'           => $iPostID,
	        );
	        wp_register_script('jscookie.js', get_template_directory_uri().'/lib/js/google-ref/jscookie.js', array('jquery'), filemtime(get_template_directory() . '/lib/js/google-ref/jscookie.js'));
	        wp_enqueue_script('jscookie.js');
	        wp_register_script('google-ref-to-frm-frontend.js', get_template_directory_uri().'/lib/js/google-ref/google-ref-to-frm-frontend.js', array('jquery'), filemtime(get_template_directory() . '/lib/js/google-ref/google-ref-to-frm-frontend.js'));
	        wp_enqueue_script('google-ref-to-frm-frontend.js');
	        wp_localize_script('google-ref-to-frm-frontend.js', 'sGFFparam', $aParamsFrontend);
		}

		add_action('admin_enqueue_scripts', 'enqueue_formidable_admin_script');
	    function enqueue_formidable_admin_script()
	    {
	  //   		echo get_template_directory_uri().'/lib/js/google-ref/jscookie.js';
			// wp_die();
	        $aParamsAdmin = array
	        (
	            'ajax_url' => admin_url('admin-ajax.php'),
	        );
	        wp_register_script( 'google-ref-to-frm-admin.js', get_template_directory_uri().'/lib/js/google-ref/google-ref-to-frm-admin.js', array('jquery'), filemtime(get_template_directory() . '/lib/js/google-ref/google-ref-to-frm-admin.js'));
	        wp_enqueue_script('google-ref-to-frm-admin.js');
	        wp_localize_script('google-ref-to-frm-admin.js', 'sGFFparam', $aParamsAdmin);
	    }
			
		add_action('frm_registered_form_actions', 'lb_register_formidable_UTMcampaign_action');
	    function lb_register_formidable_UTMcampaign_action($actions)
	    {
	        $actions['formidable_utmcampaign_action'] = 'FormidableUTMCampaign';
	        include_once(dirname(__FILE__) . '/utm--campaign-formidable-class.php');
	        return $actions;
	    }

		/* ******************************************************************************************* */
		/* ******************************** Formidable-campaign ************************************** */
		/* ******************************************************************************************* */
	

		if(!function_exists('get_acf_option_fieldkeys'))
		{
			function get_acf_option_fieldkeys()
			{
				$where['status'] = array('published');
				$aAllForms = FrmForm::getAll($where);
				$aFieldKeys = array();
				foreach($aAllForms as $iFormKey => $oForm)
				{
					if($oForm->is_template == 0)
					{
						$iFormID                = $oForm->id;
			    		$aFilters = array(
							'post_status' => 'all',
						);
						$form_actions = FrmFormAction::get_action_for_form($iFormID, 'all', $aFilters);
						foreach($form_actions as $iKey => $oFormActions)
						{
							foreach($oFormActions->post_content as $iFormActionKey => $sAction)
							{
								if($sAction == 'utm_source' || $sAction == 'utm_campaign' || $sAction == 'utm_medium' || $sAction == 'utm_term' || $sAction == 'utm_content')
								{
									$aFieldKeys[$iFormActionKey]       = $sAction;
								}
							}						
						}
					}
				}
				return $aFieldKeys;    
			}
		}
		

		if(!function_exists('get_acf_option_visitedpages'))
		{
			function get_acf_option_visitedpages()
			{
				$where['status'] = array('published');
				$aAllForms = FrmForm::getAll($where);
				$aFieldKeys = array();
				foreach($aAllForms as $iFormKey => $oForm)
				{
					if($oForm->is_template == 0)
					{
						$iFormID                = $oForm->id;
			    		$aFilters = array(
							'post_status' => 'all',
						);
						$form_actions = FrmFormAction::get_action_for_form($iFormID, 'all', $aFilters);
						foreach($form_actions as $iKey => $oFormActions)
						{
							foreach($oFormActions->post_content as $iFormActionKey => $sAction)
							{
								if($sAction == 'utm_pages')
								{
									$aFieldKeys[$iFormActionKey]       = $sAction;
								}
							}						
						}
					}
				}
				return $aFieldKeys;
			}
		}          
	}  

	// if( function_exists('acf_add_local_field_group') && !lb_is_plugin_active( '../../plugins/formidable-campaign-information/formidable-campaign-information.php' ))
	// {
	// 	acf_add_local_field_group(array (
	// 		'key' => 'group_59e9d1c35714f',
	// 		'title' => 'Formidable Campaign Information',
	// 		'fields' => array (
	// 			array (
	// 				'key' => 'field_59e9d2942649a',
	// 				'label' => 'Repeater',
	// 				'name' => 'fci_repeater_form_fields',
	// 				'type' => 'repeater',
	// 				'value' => NULL,
	// 				'instructions' => '',
	// 				'required' => 0,
	// 				'conditional_logic' => 0,
	// 				'wrapper' => array (
	// 					'width' => '',
	// 					'class' => '',
	// 					'id' => '',
	// 				),
	// 				'collapsed' => '',
	// 				'min' => 0,
	// 				'max' => 0,
	// 				'layout' => 'table',
	// 				'button_label' => 'Tilføj form',
	// 				'sub_fields' => array (
	// 					array (
	// 						'key' => 'field_59e9d2be2649b',
	// 						'label' => 'Form Name',
	// 						'name' => 'fci_form_name',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => '',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => '',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d7455faa4',
	// 						'label' => 'Reference',
	// 						'name' => 'utm_source',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => 'utm_source',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d7645faa5',
	// 						'label' => 'Kampagne',
	// 						'name' => 'utm_campaign',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => 'utm_campaign',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d7755faa6',
	// 						'label' => 'Medium',
	// 						'name' => 'utm_medium',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => 'utm_medium',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d7845faa7',
	// 						'label' => 'Søgeord',
	// 						'name' => 'utm_term',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => 'utm_term',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d79a5faa8',
	// 						'label' => 'Indhold',
	// 						'name' => 'utm_content',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => 'utm_content',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 					array (
	// 						'key' => 'field_59e9d830fa937',
	// 						'label' => 'Sider',
	// 						'name' => 'utm_pages',
	// 						'type' => 'text',
	// 						'value' => NULL,
	// 						'instructions' => '',
	// 						'required' => 0,
	// 						'conditional_logic' => 0,
	// 						'wrapper' => array (
	// 							'width' => '',
	// 							'class' => '',
	// 							'id' => '',
	// 						),
	// 						'default_value' => '',
	// 						'placeholder' => 'Field key',
	// 						'prepend' => '',
	// 						'append' => '',
	// 						'maxlength' => '',
	// 					),
	// 				),
	// 			),
	// 		),
	// 		'location' => array (
	// 			array (
	// 				array (
	// 					'param' => 'options_page',
	// 					'operator' => '==',
	// 					'value' => 'acf-options-frm-campaign-info',
	// 				),
	// 			),
	// 		),
	// 		'menu_order' => 0,
	// 		'position' => 'normal',
	// 		'style' => 'default',
	// 		'label_placement' => 'top',
	// 		'instruction_placement' => 'label',
	// 		'hide_on_screen' => '',
	// 		'active' => 1,
	// 		'description' => '',
	// 	));
	
	// }