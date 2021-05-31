<?php 

	// Adds widget: Opening hours
	class Openinghours_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'openinghours_widget',
				esc_html__( 'Opening hours', 'layback' ),
				array( 'description' => esc_html__( 'Show the opening hours from Theme setup as a widget', 'layback' ), ) // Args
			);
		}

		private $widget_fields = array(
			array(
				'label' => 'Show department name',
				'id' => 'showdepartmentn_checkbox',
				'type' => 'checkbox',
			),
			array(
				'label' => 'Hide closed days',
				'id' => 'hidecloseddays_checkbox',
				'type' => 'checkbox',
			),
		);

		public function widget( $args, $instance ) {
			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}

			// Output generated fields

			if( have_rows('openinghours', 'option') ) :
				while ( have_rows('openinghours', 'option') ) : the_row();
					if($instance['showdepartmentn_checkbox'] == true){
						echo '<h2 class="department_name">' . get_sub_field('name') . '</h2>';
					}

					if( have_rows('hours') )
					{


						echo '<table class="opening_hours_table">';
							echo '<tbody>';
								while ( have_rows('hours') ) { the_row();

									if($instance['hidecloseddays_checkbox'] == 1 && get_sub_field('closed') == 1 )
									{

									}else{
										echo '<tr>';
											echo '<td>' . get_sub_field('name') . '</td>';
											if( get_sub_field('closed') != 1 )
											{
												echo '<td>' . get_sub_field('open') . '</td>';
												echo '<td>' . get_sub_field('close') . '</td>';
											}
											if( get_sub_field('closed') == 1 )
											{
												echo '<td colspan="3">' . __('Closed', 'layback') . '</td>';
											}
										echo '</tr>';	
									}
								}
							echo '</tbody>';
						echo '</table>';
					}
				endwhile;
			endif;
			
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

	function register_openinghours_widget() {
		register_widget( 'Openinghours_Widget' );
	}
	add_action( 'widgets_init', 'register_openinghours_widget' );