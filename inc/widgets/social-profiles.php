<?php 
/**
 * Social Profile Widget
 *
 * @package Themereps_Helper
 * @since version 1.0.0
*/
if ( th_fs()->can_use_premium_code() ) {
	class Themereps_Helper_Social_Icons extends WP_Widget {
		
		function __construct() {
			parent::__construct(
			
			// Base ID of your widget
			'themereps_helper_social_icons',
			
			// Widget name will appear in UI
			esc_html__('03- Themereps - Social Profiles', 'themereps-helper'),
			
			// Widget description
			array( 'description' => esc_html__( 'Display your social profile on widget areas', 'themereps-helper' ), )
			);
		}

		// Widget Backend
		public function form( $instance ) {
			
			$title        = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
			$facebook     = isset( $instance['facebook'] ) ? esc_url( $instance['facebook']) : '';
			$twitter      = isset( $instance['twitter'] ) ? esc_url( $instance['twitter']) : '';
			$instagram    = isset( $instance['instagram'] ) ? esc_url( $instance['instagram']) : '';
			$linkedin     = isset( $instance['linkedin'] ) ? esc_url( $instance['linkedin']) : '';
			$pinterest    = isset( $instance['pinterest'] ) ? esc_url( $instance['pinterest']) : '';
			$youtube      = isset( $instance['youtube'] ) ? esc_url( $instance['youtube']) : '';
			
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title:', 'themereps-helper' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_url( $facebook ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_url( $twitter ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_url( $instagram ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>">
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_url( $pinterest ); ?>">
		</p>
		

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:','themereps-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>">
		</p>

		<?php
		}
		
		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance                 = array();
			$instance['title']        = (!empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['facebook']     = (!empty($new_instance['facebook']) ) ? esc_url_raw($new_instance['facebook']) : '';
			$instance['twitter']      = (!empty($new_instance['twitter']) ) ? esc_url_raw($new_instance['twitter']) : '';
			$instance['instagram']    = (!empty($new_instance['instagram']) ) ? esc_url_raw($new_instance['instagram']) : '';
			$instance['linkedin']     = (!empty($new_instance['linkedin']) ) ? esc_url_raw($new_instance['linkedin']) : '';
			$instance['pinterest']    = (!empty($new_instance['pinterest']) ) ? esc_url_raw($new_instance['pinterest']) : '';
			$instance['youtube']      = (!empty($new_instance['youtube']) ) ? esc_url_raw($new_instance['youtube']) : '';
			return $instance;
		}
		
		
		// Creating widget front-end
		public function widget( $args, $instance ) {

			$title       = isset($instance['title']) ? $instance['title'] : '';
			$facebook    = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
			$twitter     = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
			$instagram   = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
			$linkedin    = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
			$pinterest   = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
			$youtube     = isset( $instance['youtube'] ) ? $instance['youtube'] : '';

			echo $args['before_widget'];

			if ( ! empty( $title ) ){
				echo $args['before_title'] . $title . $args['after_title'];
			}

		?>
			<div class="social-icons crcl">
				<?php if(!empty($facebook) ){ ?>
					<a href="<?php echo esc_url($facebook); ?>"><span class="icomoon-facebook"></span><span class="screen-reader-text"><?php esc_html_e( 'Facebook', 'themereps-helper' );?></span></a>
				<?php } ?>
				<?php if(!empty($twitter) ){ ?>
					<a href="<?php echo esc_url($twitter); ?>"><span class="icomoon-twitter"></span><span class="screen-reader-text"><?php esc_html_e( 'Twitter', 'themereps-helper' );?></span></a>
				<?php } ?>
				<?php if(!empty($instagram) ){ ?>
					<a href="<?php echo esc_url($instagram); ?>"><span class="icomoon-instagram"></span><span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'themereps-helper' );?></span></a>
				<?php } ?>
				<?php if(!empty($linkedin) ){ ?>
					<a href="<?php echo esc_url($linkedin); ?>"><span class="icomoon-linkedin"></span><span class="screen-reader-text"><?php esc_html_e( 'Linkedin', 'themereps-helper' );?></span></a>
				<?php } ?>
				<?php if(!empty($pinterest) ){ ?>
					<a href="<?php echo esc_url($pinterest); ?>"><span class="icomoon-pinterest"></span><span class="screen-reader-text"><?php esc_html_e( 'Pinterest', 'themereps-helper' );?></span></a>
				<?php } ?>
				<?php if(!empty($youtube) ){ ?>
					<a href="<?php echo esc_url($youtube); ?>"><span class="icomoon-youtube"></span><span class="screen-reader-text"><?php esc_html_e( 'Youtube', 'themereps-helper' );?></span></a>
				<?php } ?>
			</div>
		<?php
			echo $args['after_widget'];
		}
	}
	// Register and load the widget
	function themereps_helper_social_icons_widget() {
		register_widget( 'Themereps_Helper_Social_Icons' );
	}
	add_action( 'widgets_init', 'themereps_helper_social_icons_widget' );
}