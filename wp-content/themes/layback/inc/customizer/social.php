<?php
	
	/* Add section
	------------------------------------------------------------------ */

	$wp_customize->add_section(
		'layback_socialmedia_section', 
		array(
			'title'       => __( 'Social media', 'laybackparent' ),
			'priority'    => 30,
			'capability'  => 'edit_theme_options',
			'panel'  		=> 'layback_theme_panel',
			'description' => __('Social media', 'laybackparent'),
		) 
	);

	/* Add facebook url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_facebook',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_facebook',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Facebook', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add linkedin url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_linkedin',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_linkedin',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'linkedIn', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add twitter url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_twitter',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_twitter',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Twitter', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add instagram url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_instagram',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_instagram',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Instagram', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add pinterest url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_pinterest',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_pinterest',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Pinterest', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add youtube url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_youtube',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_youtube',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Youtube', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);

	/* Add twitch url
	------------------------------------------------------------------ */

	$wp_customize->add_setting(
		'layback_twitch',
		array(
			'default' 		=> '',
			// 'type' 			=> 'option',
			'transport' 	=> 'refresh',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Control(
			$wp_customize,
			'layback_twitch',
			array(
				'type' 			=> 'url',
				'label' 		=> __( 'Twitch', 'laybackparent' ),
				'description' 	=> __( '', 'laybackparent'),
				'section' 		=> 'layback_socialmedia_section',
				'priority' 		=> 10,
			)
		)
	);