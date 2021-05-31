<?php 

	// Register and load the widget
	function register_layback_childpage_nav() {
		register_widget( 'layback_childpage_nav' );
	}
	add_action( 'widgets_init', 'register_layback_childpage_nav' );
	 
	// Creating the widget 
	class layback_childpage_nav extends WP_Widget {
	 
		function __construct() {
			parent::__construct(
		 
			// Base ID of your widget
			'layback_childpage_nav', 
			 
			// Widget name will appear in UI
			__('Childpage navigation', 'laybackparent'), 
		 
			// Widget description
			array( 'description' => __( 'Shows a navigation menu with all child pages of current page.', 'laybackparent' ), ) 
			);
		}
		 
		// Creating widget front-end
		public function widget( $args, $instance ) {
			$page_has_childs = get_pages( array( 'child_of' => get_the_ID() ) );
	 		$endvalue = get_post_ancestors(get_the_ID());
	 		$top_page_id = (!empty($endvalue)) ? end($endvalue) : get_the_ID();

	 		if(!empty($page_has_childs) || !empty($endvalue) && empty($page_has_childs)) :
				$title = apply_filters( 'widget_title', $instance['title'] );
			 
				// before and after widget arguments are defined by themes
				echo $args['before_widget'];
				if ( ! empty( $title ) ) :
					echo $args['before_title'] . $title . $args['after_title'];
				endif;

		 	    


		 		// echo '<pre>';
		 		// 	print_r($top_page_id);
		 		// echo '</pre>';

				// This is where you run the code and display the output
				$args_wp_list_pages = array(
					'child_of' => $top_page_id,
					'post_type'   => 'page',
					'numberposts' => -1,
					'post_status' => 'publish',
					'sort_column'  => 'menu_order, post_title',
				    'title_li'		=> false,
				);
				echo '<ul class="menu">';
				wp_list_pages( $args_wp_list_pages );
				echo '</ul>';

				echo $args['after_widget'];
			endif;
		}
		         
		// Widget Backend 
		public function form( $instance ) {
			if ( isset( $instance[ 'title' ] ) ) :
				$title = $instance[ 'title' ];
			else :
				$title = __( 'New title', 'laybackparent' );
			endif;
			// Widget admin form
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<?php 
		}
			// Updating widget replacing old instances with new
			public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
	}