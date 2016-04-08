<?php
/*
Plugin Name: KK Events plugin
Plugin URI: http://www.bootstrap4me.com
Description: A Events plugin for testing purposes
Version: 1.0.1
Author: Kostas Kakoulis
Author URI: http://www.bootstrap4me.com
License: GPLv2
*/

/** WordPress Administration Bootstrap */
require_once( dirname( __FILE__ ) . '/includes/kk-event-widget.php' );

add_action( 'wp_dashboard_setup', 'kk_b4meEVENT_dashboard_widget' );

/**
 * Enqueue jQuery-UI in the WordPress admin.
 *
 * @param int $hook Hook suffix for the current admin page.
 */
function kk_b4meEVENT_enqueue_admin_script( $hook ) {
    if ( 'index.php' != $hook ) {
        return;
    }
    wp_register_style( 'jquery_ui_css', plugin_dir_url( __FILE__ ) . 'includes/assets/jquery-ui/jquery-ui.min.css', false, '1.0.0' );
    wp_enqueue_style( 'jquery_ui_css' );

    wp_enqueue_script( 'jquery_ui', plugin_dir_url( __FILE__ ) . 'includes/assets/jquery-ui/jquery-ui.min.js', array('jquery'), '1.0' );
    wp_enqueue_script( 'datepicker_el', plugin_dir_url( __FILE__ ) . 'includes/assets/jquery-ui/datepicker-el.js', array('jquery_ui'), '1.0' );
    wp_enqueue_script( 'kk-event_js', plugin_dir_url( __FILE__ ) . 'includes/kk-event.js', array('jquery_ui'), '1.0' );
}
add_action( 'admin_enqueue_scripts', 'kk_b4meEVENT_enqueue_admin_script' );

/**
 * Fires before the Widgets administration page content loads.
 *
 * @since 3.0.0
 */
function kk_b4meEVENT_dashboard_widget() {
	// create a custom dashboard widget
	wp_add_dashboard_widget( 'dashboard_events_widget', 'My Events Widget', 'kk_b4meEVENT_dashboard_event_display', 'kk_b4meEVENT_dashboard_event_setup' ); 
}

/**
 * Fires before the Widgets administration page content loads.
 *
 * @since 3.0.0
 */
function kk_b4meEVENT_dashboard_event_display() {
	// load widget option
	$kk_b4meEVENT_event_name_option = get_option( 'kk_b4meEVENT_event_name' );
	$kk_b4meEVENT_event_description_option = get_option( 'kk_b4meEVENT_event_description' );
	$kk_b4meEVENT_event_date_from_option = get_option( 'kk_b4meEVENT_event_date_from' );
	$kk_b4meEVENT_event_date_to_option = get_option( 'kk_b4meEVENT_event_date_to' );

	$kk_b4meEVENT_event_output = '';

	// display the widget data 
	echo '<div class="event-widget">';

	$kk_b4meEVENT_event_output .= "<h3>This is the event Titel: <strong>$kk_b4meEVENT_event_name_option</strong></h3>";
	$kk_b4meEVENT_event_output .= "<p>This is the event Description: <strong>$kk_b4meEVENT_event_description_option</strong></p>";
	$kk_b4meEVENT_event_output .= "From: $kk_b4meEVENT_event_date_from_option </br>";
	$kk_b4meEVENT_event_output .= "To: $kk_b4meEVENT_event_date_to_option </br>";

	echo $kk_b4meEVENT_event_output;

	echo '</div>';
}

/**
 * Fires before the Widgets administration page content loads.
 *
 * @since 3.0.0
 */
function kk_b4meEVENT_dashboard_event_setup() {
	// check if the curent user can publish
	$can_publish = current_user_can('administrator');

	// check if option is set before saving
	if ( isset( $_POST['kk_b4meEVENT_event_name_option']) ) {
		// retrieve the option value from the form
		$kk_b4meEVENT_event_name_option = esc_attr( $_POST['kk_b4meEVENT_event_name_option'] );

		//save the value as an option
		update_option( 'kk_b4meEVENT_event_name', $kk_b4meEVENT_event_name_option );
	}

	// check if option is set before saving
	if ( isset( $_POST['kk_b4meEVENT_event_description_option']) ) {
		// retrieve the option value from the form
		$kk_b4meEVENT_event_description_option = esc_attr( $_POST['kk_b4meEVENT_event_description_option'] );

		//save the value as an option
		update_option( 'kk_b4meEVENT_event_description', $kk_b4meEVENT_event_description_option );
	}

	// check if option is set before saving
	if ( isset( $_POST['kk_b4meEVENT_event_date_from_option']) ) {
		// retrieve the option value from the form
		$kk_b4meEVENT_event_date_from_option = esc_attr( $_POST['kk_b4meEVENT_event_date_from_option'] );

		//save the value as an option
		update_option( 'kk_b4meEVENT_event_date_from', $kk_b4meEVENT_event_date_from_option );
	}

	// check if option is set before saving
	if ( isset( $_POST['kk_b4meEVENT_event_date_to_option']) ) {
		// retrieve the option value from the form
		$kk_b4meEVENT_event_date_to_option = esc_attr( $_POST['kk_b4meEVENT_event_date_to_option'] );

		//save the value as an option
		update_option( 'kk_b4meEVENT_event_date_to', $kk_b4meEVENT_event_date_to_option );
	}

	// load the saved options if it's exists
	$kk_b4meEVENT_event_name_option = get_option( 'kk_b4meEVENT_event_name' );
	$kk_b4meEVENT_event_description_option = get_option( 'kk_b4meEVENT_event_description' );
	$kk_b4meEVENT_event_date_from_option = get_option( 'kk_b4meEVENT_event_date_from' );
	$kk_b4meEVENT_event_date_to_option = get_option( 'kk_b4meEVENT_event_date_to' );

	?>
	<!-- input Field for Event Title -->
	<label for="kk_b4meEVENT_event_name_option">
		Event Title: <input type='text' name='kk_b4meEVENT_event_name_option' id='kk_b4meEVENT_event_name_option'
value='<?php echo esc_attr( $kk_b4meEVENT_event_name_option ); ?>' size='50' />

	</label>

	<!-- Text Area for event description -->
	<p><label for="kk_b4meEVENT_event_description_option"><?php _e('Description of the Event') ?></label></p>

	<textarea name="kk_b4meEVENT_event_description_option" id="kk_b4meEVENT_event_description_option" class="large-text code" rows="3"><?php echo esc_textarea( get_option('kk_b4meEVENT_event_description') ); ?></textarea>

	<label for="from">From</label>
	<input type="text" name="kk_b4meEVENT_event_date_from_option" id="kk_b4meEVENT_event_date_from_option" value="<?php echo esc_attr( $kk_b4meEVENT_event_date_from_option ); ?>">
	<label for="to">to</label>
	<input type="text" name="kk_b4meEVENT_event_date_to_option" id="kk_b4meEVENT_event_date_to_option" value="<?php echo esc_attr( $kk_b4meEVENT_event_date_to_option ); ?>">

	<?php
	if ( $can_publish ) : // Contributors don't get to choose the date of publish ?>
		<?php 
			$datef = __( 'M j, Y @ H:i' );
			$stamp = __('Uploaded on: <b>%1$s</b>');
			//$date = date_i18n( $datef, strtotime( $post->post_date ) );
		?>
	<?php endif ?>
	
	<?php 
}