<?php 
    /**
	 * About Us widgets
	 *
	 * @package Themereps_Helper
	 * @since version 1.0.0
	*/
if ( th_fs()->can_use_premium_code() ) {
	class Themereps_Helper_About_Info_Widget extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'themereps_helper_about_info',
			
			// Widget name will appear in UI
			esc_html__('01- Themereps - About Info', 'themereps-helper'),
			
			// Widget description
			array( 'description' => esc_html__( 'A widget that displays logo with short description.', 'themereps-helper' ), )
			);
		}

		public function form( $instance ) {

			/* Set up some default widget settings. */
			$title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$image          = isset( $instance['image'] ) ? esc_url( $instance['image'] ) : '';
			$description    = isset( $instance['description'] ) ? esc_html( $instance['description'] ) : '';
			
			?>

			<!-- Widget Title: Text Input -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'themereps-helper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>

			<!-- image url -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php _e( 'Image URL:', 'themereps-helper' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
			</p>

			<!-- description -->
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php _e( 'Description:', 'themereps-helper' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo wp_kses_post( $description ); ?></textarea>
			</p>

			<?php
		}

		/**
		 * How to display the widget on the screen.
		 */
		public function widget( $args, $instance ) {

			/* Our variables from the widget settings. */
			$title = isset($instance['title']) ? $instance['title'] : '';
			$image = isset($instance['image']) ? $instance['image'] : '';
			$description = isset($instance['description']) ? $instance['description'] : '';

			/* Before widget (defined by themes). */
			echo $args['before_widget'];

			/* Display the widget title if one was input (before and after defined by themes). */
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}

			?>

			<div class="widget-about">

				<?php if ( $image ) : ?>
				<div class="footer-logo">
					<img class="img-responsive about-image" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>"/>
				</div>	 
				<?php endif; ?>
				
				<?php if ( $description ) : ?>
					<p><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>

			</div>

			<?php

			/* After widget (defined by themes). */
			echo $args['after_widget'];
		}

		/**
		 * Update the widget settings.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			
			$instance['title']       = sanitize_text_field( $new_instance['title'] );
			$instance['image']       = esc_url_raw( $new_instance['image'] );
			$instance['description'] = sanitize_text_field( $new_instance['description'] );

			return $instance;
		}
	}
	function themereps_helper_load_about_widget() {
		register_widget( 'Themereps_Helper_About_Info_Widget' );
	}
	add_action( 'widgets_init', 'themereps_helper_load_about_widget' );
}