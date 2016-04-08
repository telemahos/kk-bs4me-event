<?php 
/**
  * 
  */
// use widget_init action hook to execute widget register function
add_action( 'widgets_init', 'kk_event_widget_register' );

// register the Widget
function kk_event_widget_register() {
	register_widget( 'KK_event' );
	wp_register_widget_control(
			'KK_event',		// id
			'KK_event',		// name
			'kk_event_widget_control'	// callback function
		);
}

// Event Widget Class 
class KK_event extends WP_Widget
{	
	public function __construct() {
		$widget_ops = array (
			'classname' 	=> 'KK_event_class',
			'description'	=> 'Display event details on widget'
		);
		parent::__construct( 'KK_event', 'KK Event Widget', $widget_ops );
		
	}

	public function kk_event_widget_control( $args=array(), $params=array() ) {
		// echo "kostas widget test";
		if ( isset( $_POST['submitted'] ) ) {
			update_option( 'kk_b4meEVENT_event_name', $_POST[ 'kk_name' ] );
			update_option( 'kk_b4meEVENT_event_description', $_POST[ 'kk_description' ] );
			update_option( 'kk_b4meEVENT_event_date_from', $_POST[ 'kk_from' ] );
			update_option( 'kk_b4meEVENT_event_date_to', $_POST[ 'kk_to' ] );
		}

		//load options
		$kk_bs4me_event_name = get_option( 'kk_b4meEVENT_event_name' );
		$kk_bs4me_event_description = get_option( 'kk_b4meEVENT_event_description' );
		$kk_bs4me_event_from = get_option( 'kk_b4meEVENT_event_date_from' );
		$kk_bs4me_event_to = get_option( 'kk_b4meEVENT_event_date_to' );
		?>

		Widget Title:<br />
		<input type="text" class="widefat" name="kk_bs4me_event_name" value=<?php echo esc_attr('$kk_bs4me_event_name');  ?> />
		
		<?php
	}

	public function form( $instance ) {
		// displays the widget form in the admin dashboard
	}

	public function update( $new_instance, $old_instance ) {
		// process widget options to save

	}

	public function widget( $args, $instance ) {
		// displays the widget
	}

}