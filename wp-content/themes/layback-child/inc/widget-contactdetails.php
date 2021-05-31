<?php 

	// Adds widget: Contact details
	class Contactdetails_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'contactdetails_widget',
				esc_html__( 'Contact details', 'layback' ),
				array( 'description' => esc_html__( 'Show contact information as a widget', 'layback' ), ) // Args
			);
		}

		private $widget_fields = array(
			array(
				'label' => 'Show address',
				'id' => 'showaddress_checkbox',
				'type' => 'checkbox',
			),
			array(
				'label' => 'Show CVR',
				'id' => 'showcvr_checkbox',
				'type' => 'checkbox',
			),
			array(
				'label' => 'Show phonenumber',
				'id' => 'showphonenumber_checkbox',
				'type' => 'checkbox',
			),
			array(
				'label' => 'Show mail',
				'id' => 'showmail_checkbox',
				'type' => 'checkbox',
			),
		);

		public function widget( $args, $instance ) {
			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}

			// Output generated fields
			$company 	= get_field('company', 'option');
			$cvr 		= get_field('cvr', 'option');
			$phone 		= get_field('phone', 'option');
			$mail 		= get_field('mail', 'option');
			$address 	= get_field('address', 'option');

			echo '<p>';
				echo '<strong>' . $company . '</strong><br />';

				if($instance['showaddress_checkbox'] == 1)  {
					echo $address['street'] . '<br />';
					echo $address['zip'] . ' ' . $address['city'] . '<br />';
				}

				if($instance['showcvr_checkbox'] == 1) {
					echo __('Vat no', 'layback') . ': ' . $cvr . '<br />';
					echo '</p>';
				}
				
				if($instance['showphonenumber_checkbox'] == 1 || $instance['showmail_checkbox'] == 1) {
					echo '<p>';
						
						if($instance['showphonenumber_checkbox'] == 1 )
						{
							echo __('Phone', 'layback') . ': ';
							nicephone($phone, 2, 'widget phone');
							echo '<br />';
						}

						if($instance['showmail_checkbox'] == 1 )
						{
							echo __('Mail', 'layback') . ': ';
							nicemail($mail, true, 'widget mail', false);
							echo '<br />';
						}

					echo '</p>';
				}
			
			echo $args['after_widget'];
		}

		public function field_generator( $instance ) {
			$output = '';
			foreach ( $this->widget_fields as $widget_field ) {
				$default = '';
				if ( isset($widget_field['default']) ) {
					$default = $widget_field['default'];
				}
				$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'layback' );
				switch ( $widget_field['type'] ) {
					case 'checkbox':
						$output .= '<p>';
						$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
						$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'layback' ).'</label>';
						$output .= '</p>';
						break;
					default:
						$output .= '<p>';
						$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'layback' ).':</label> ';
						$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
						$output .= '</p>';
				}
			}
			echo $output;
		}

		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'layback' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'layback' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php
			$this->field_generator( $instance );
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			foreach ( $this->widget_fields as $widget_field ) {
				switch ( $widget_field['type'] ) {
					default:
						$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
				}
			}
			return $instance;
		}
	}

	function register_contactdetails_widget() {
		register_widget( 'Contactdetails_Widget' );
	}
	add_action( 'widgets_init', 'register_contactdetails_widget' );