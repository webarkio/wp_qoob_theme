<?php
/**
 * Plugin Name: Social Icons Widget
 *
 * @package qoob
 */

/**
 * Adds Social_Icons widget.
 */
class Qoob_Social_Icons extends WP_Widget {

	/**
	 * Array icons
	 *
	 * @var $icons_class
	 */
	public $icons_class = array(
		'twitter' => 'fa fa-twitter',
		'facebook' => 'fa fa-facebook-official',
		'google' => 'fa fa-google-plus',
		'instagram' => 'fa fa-instagram',
		'youtube' => 'fa fa-youtube',
	);

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct( 'Qoob_Social_Icons', esc_html__( 'Social Networks Profiles', 'qoob' ), array( 'description' => __( 'Links to Author social media profile', 'qoob' ) ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$links = '';
		echo wp_kses( $args['before_widget'], 'div' );
		?>
		<div class="social-icon-block  black-bg">
			<div class="block-icons">
				<?php
				foreach ( $instance as $key => $value ) {
					if ( ! empty( $value ) ) {
						echo '<a class="social-icons ' . esc_html( $this->icons_class[ $key ] ) . ' ' . esc_html( $key ) . '" href="' . esc_url( $value ) . '"></a>';
					}
				}
				?>
			</div>
		</div>
		<?php
		echo wp_kses( $args['after_widget'] , 'div' );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( true === empty( $instance ) ) {
			$instance['twitter'] = '#';
			$instance['facebook'] = '#';
			$instance['google'] = '#';
			$instance['instagram'] = '#';
			$instance['youtube'] = '#';
		}
		foreach ( $instance as $key => $value ) {
			$id = $this->get_field_id( $key );
			$name = $this->get_field_name( $key );
			?>
			<p>
				<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_attr( ucfirst( $key ) ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>">
			</p>
			<?php
		}

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$array = array();
		$array['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? esc_url_raw( $new_instance['twitter'] ) : '';
		$array['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? esc_url_raw( $new_instance['facebook'] ) : '';
		$array['google'] = ( ! empty( $new_instance['google'] ) ) ? esc_url_raw( $new_instance['google'] ) : '';
		$array['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? esc_url_raw( $new_instance['instagram'] ) : '';
		$array['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? esc_url_raw( $new_instance['youtube'] ) : '';

		return $array;
	}

}

add_action( 'widgets_init', 'qoob_register_social_profile' );
/**
 * Register Social_Icons widget
 */
function qoob_register_social_profile() {
	register_widget( 'Qoob_Social_Icons' );
}

add_action( 'wp_enqueue_scripts', 'qoob_social_icons_widget_css' );
/**
 * Enqueue css stylesheet
 */
function qoob_social_icons_widget_css() {
	wp_enqueue_style( 'qoob-social-icons-widget', get_template_directory_uri() . '/inc/widgets/social_icons/social-icons-widget.css' );
}
