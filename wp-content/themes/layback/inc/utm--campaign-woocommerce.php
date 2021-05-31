<?php
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		if(function_exists('acf_add_local_field_group') ):
		acf_add_local_field_group(array(
			'key' => 'group_5a5c97c711eb5',
			'title' => 'Google UTM Data',
			'fields' => array(
				array(
					'key' => 'field_5a5c97d523f90',
					'label' => 'Søgeord',
					'name' => 'order_utm_term',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5a5c999923f91',
					'label' => 'Medium',
					'name' => 'order_utm_medium',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5a5c99a323f92',
					'label' => 'Reference',
					'name' => 'order_utm_source',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5a5c99ab23f93',
					'label' => 'Indhold',
					'name' => 'order_utm_content',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_5a5c99b023f94',
					'label' => 'Kampagne',
					'name' => 'order_utm_campaign',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'shop_order',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
		));
		endif;

		add_action('wp_footer', 'woocommerce_order_utm_js');
		function woocommerce_order_utm_js()
		{
			?>
				<script type="text/javascript">
					var aUTMNames = ["utm_term", "utm_medium", "utm_source", "utm_content", "utm_campaign"];
					for(iKey in aUTMNames)
					{
						sUTMName = aUTMNames[iKey];
						if(findGetParameter(sUTMName) != null)
						{
							sRefParameterValue = findGetParameter(sUTMName);
							Cookies.set(sRefParameter, sRefParameterValue, { expires: 29 });
						}
					}
					
					function findGetParameter(parameterName) 
					{
					    var result = null,
					        tmp = [];
					    location.search
					        .substr(1)
					        .split("&")
					        .forEach(function (item) {
					          tmp = item.split("=");
					          if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
					        });
					    return result;
					}
				</script>
			<?php
		}


		add_action('woocommerce_thankyou', 'utm_to_order', 10, 1);
		function utm_to_order($order_id)
		{
			if(isset($_COOKIE['utm_term']) && !empty($_COOKIE['utm_term']))
			{
				update_field( 'order_utm_term', $_COOKIE['utm_term'], $order_id );
			}

			if(isset($_COOKIE['utm_medium']) && !empty($_COOKIE['utm_medium']))
			{
				update_field( 'order_utm_medium', $_COOKIE['utm_medium'], $order_id );	
			}

			if(isset($_COOKIE['utm_source']) && !empty($_COOKIE['utm_source']))
			{
				update_field( 'order_utm_source', $_COOKIE['utm_source'], $order_id );
			} 

			if(isset($_COOKIE['utm_content']) && !empty($_COOKIE['utm_content']))
			{
				update_field( 'order_utm_content', $_COOKIE['utm_content'], $order_id );
			}

			if(isset($_COOKIE['utm_campaign']) && !empty($_COOKIE['utm_campaign']))
			{
				update_field( 'order_utm_campaign', $_COOKIE['utm_campaign'], $order_id);	
			}
		}
	}