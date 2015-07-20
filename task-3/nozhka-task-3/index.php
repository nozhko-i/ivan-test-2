<?php
/**
 * Plugin Name: Nozhka Task 3 Plugin
 * Plugin URI: https://github.com/nozhko-i/nozhka-task-3-plugin
 * Description: PHP 5.3+ plugin
 * Version: 1.0.0
 * Author: Nozhka Ivan
 * Author URI: https://github.com/nozhko-i
 */

class Nozhka_Task3_Plugin {

	/**
	 * PHP Supported version
	 * @var string
	 */
	var $version = '5.3';

	/**
	 * Constructor
	 * @return void
	 */
	public function __construct()
	{

		add_action( 'admin_init', array( $this, 'install' ) );

		// Base plugin directory uri
		$this->base = plugins_url('nozhka-task-3');
	}

	/**
	 * Check PHP version
	 * @return void
	 */
	public function install()
	{
		// Compare installed PHP version and supported PHP version
		if ( version_compare( phpversion() , $this->version ) == -1) {

			// Get activated plugins list
			$active_plugins = get_option('active_plugins');

			if ( ! $active_plugins ) {
				return;
			}

			// Return if plugin already deactivated
			if( ! in_array( 'nozhka-task-3/index.php', $active_plugins ) ) {
				return;
			}

			// Deactivate plugin
			for ( $i = 0; $i < count( $active_plugins ); $i++ ) {
				if ( $active_plugins[$i] == 'nozhka-task-3/index.php' ) {
					unset( $active_plugins[$i] );
				}
			}

			// Update option. Deactivate plugin
			update_option( 'active_plugins', $active_plugins );

			// Admin notice
			add_action( 'admin_notices', array( $this, 'return_admin_notice' ) );

			// Hide updated message
			add_action( 'admin_head', array( $this, 'remove_updated_notice' ) );
		}
	}

	/**
	 * Error message
	 * @return void
	 */
	public function return_admin_notice()
	{
		$message = "Error: Not supported PHP version <strong>" . phpversion() . "</strong>. Expected " . $this->version;
		echo"<div class=\"error notice is-dismissible\"><p>$message</p></div>";
	}

	/**
	 * Hide updated message
	 * @return void
	 */
	public function remove_updated_notice()
	{
		?>
		<style type="text/css">
			div.updated { display: none; }
		</style>
		<?php
	}
}


// Run the plugin
add_action('init', 'call_nozhka_task_3');

/**
 * Create object
 */
function call_nozhka_task_3() {
	new Nozhka_Task3_Plugin();
}
