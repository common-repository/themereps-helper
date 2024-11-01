<?php
/**
 * Recent Post Widget
 *
 * @package Themereps_Helper
 * @since version 1.0.0
*/
if ( th_fs()->can_use_premium_code() ) {
	class Themereps_Helper_Recent_Posts extends WP_Widget {
		
		function __construct() {
			parent::__construct(

				// Base ID of your widget
				'themereps_helper_recent_posts',

				// Widget name will appear in UI
				esc_html__('04- Themereps - Recent Posts', 'themereps-helper'),

				// Widget description
				array( 'description' => esc_html__( 'Display most recent post on widget area', 'themereps-helper' ), )
			);
		}
		
		// Widget Backend
		public function form( $instance ) {

			/* Set up some default widget settings. */
		   $defaults = array(
			   'title'              => '',
			   'category'           => '',
			   'post_count'         => 3,
		   );
		   $instance = wp_parse_args( (array) $instance, $defaults );
			 ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'themereps-helper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php _e( 'Enter categroy name, multiple names should be separated by comma or leave empty to show latest posts:', 'themereps-helper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>" type="text" value="<?php echo esc_attr( $instance['category'] ); ?>" />
			</p>	

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>"><?php _e( 'Number of Posts:', 'themereps-helper' ); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'post_count' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'post_count' )); ?>" type="number" value="<?php echo esc_attr( $instance['post_count'] ); ?>" />
			</p>

			<?php
		}

		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title']              =   ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : __('Recent Posts', 'themereps-helper');
			$instance['post_count']         =   ( ! empty( $new_instance['post_count'] ) ) ? absint($new_instance['post_count']) : 3;
			$instance['category'] 		    =   ( ! empty( $new_instance['category'] ) ) ? strip_tags( $new_instance['category'] ) : '';
			return $instance;
		}

		// Creating widget front-end
		public function widget( $args, $instance ) {

			$title	= apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Recent Posts', 'themereps-helper') : $instance['title'], $instance, $this->id_base );
			$post_count	= isset( $instance['post_count'] ) ? $instance['post_count'] : 3;
			$category   = isset( $instance['category'] ) ? esc_attr($instance['category']) : '';

			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];

				$widget_args	=	array(
					'posts_per_page'		=>	$post_count,
					'post_status'           => 'publish',
					'ignore_sticky_posts'	=>	true,
					'category_name'		  => $category
				);

				$widget_query	=	new WP_Query( $widget_args );

				if ( $widget_query->have_posts() ) :
					while ($widget_query->have_posts() ) : $widget_query->the_post(); ?>
						<div class="widget-post">

							<?php if ( has_post_thumbnail() ): ?>
							<div class="wpost-thumb">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('themereps-helper-widget-thumb'); ?></a>
							</div>
							<?php endif; ?>

							<div class="wpost-entry">
								<h6><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h6>
								<p class="wpost-meta"><?php echo get_the_date('d F, Y'); ?></p>
							</div>

						</div>
					<?php
					endwhile;
				endif;
						
				echo $args['after_widget'];
		}
	}
	// Register and load the widget
	function themereps_helper_recent_posts_widget() {
		register_widget( 'Themereps_Helper_Recent_Posts' );
	}
	add_action( 'widgets_init', 'themereps_helper_recent_posts_widget' );
}