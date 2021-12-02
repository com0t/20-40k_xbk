<?php

class MailsterTester {

	private $plugin_path;
	private $plugin_url;

	public function __construct() {

		$this->plugin_path = plugin_dir_path( MAILSTER_TESTER_FILE );
		$this->plugin_url  = plugin_dir_url( MAILSTER_TESTER_FILE );

		register_activation_hook( MAILSTER_TESTER_FILE, array( &$this, 'activate' ) );
		register_deactivation_hook( MAILSTER_TESTER_FILE, array( &$this, 'deactivate' ) );

		load_plugin_textdomain( 'mailster-tester' );

		add_action( 'init', array( &$this, 'init' ), 1 );
	}


	public function activate( $network_wide ) { }


	public function deactivate( $network_wide ) { }


	public function init() {

		   add_action( 'admin_menu', array( $this, 'admin_menu' ) );

	}



	public function admin_menu() {
		$hook = add_management_page( 'Mailster Tester', 'Mailster Tester', 'install_plugins', 'mailster-tester', array( $this, 'admin_page' ), '' );
	}

	public function admin_page() {

		$errors = $this->check_compatibility();

		if ( $errors->error_count ) {

			echo '<h3>Following Errors occurred</h3>';
			echo '<div class="error"><p><strong>' . implode( '<br>', $errors->errors->get_error_messages() ) . '</strong></p></div>';

		} else {

			echo '<h3>No errors where found!</h3>';

		}

		if ( $errors->warning_count ) {

			echo '<h3>Following Warnings occurred</h3>';
			echo '<div class="error"><p><strong>' . implode( '<br>', $errors->warnings->get_error_messages() ) . '</strong></p></div>';

		} else {

			echo '<h3>No warnings where found!</h3>';

		}

		echo '<p>Thanks for testing!</p>';

	}

	public function check_compatibility( $notices = true, $die = false ) {

		$errors = (object) array(
			'error_count'   => 0,
			'warning_count' => 0,
			'errors'        => new WP_Error(),
			'warnings'      => new WP_Error(),
		);

		$upload_folder = wp_upload_dir();

		$content_dir = trailingslashit( $upload_folder['basedir'] );

		if ( version_compare( PHP_VERSION, '5.3' ) < 0 ) {
			$errors->errors->add( 'minphpversion', sprintf( 'Mailster requires PHP version 5.3 or higher. Your current version is %s. Please update or ask your hosting provider to help you updating.', PHP_VERSION ) );
		}
		if ( version_compare( get_bloginfo( 'version' ), '3.8' ) < 0 ) {
			$errors->errors->add( 'minphpversion', sprintf( 'Mailster requires WordPress version 3.8 or higher. Your current version is %s.', get_bloginfo( 'version' ) ) );
		}
		if ( ! class_exists( 'DOMDocument' ) ) {
			$errors->errors->add( 'DOMDocument', 'Mailster requires the <a href="https://php.net/manual/en/class.domdocument.php" target="_blank">DOMDocument</a> library.' );
		}
		if ( ! function_exists( 'fsockopen' ) ) {
			$errors->warnings->add( 'fsockopen', 'Your server does not support <a href="https://php.net/manual/en/function.fsockopen.php" target="_blank">fsockopen</a>.' );
		}
		if ( ! is_dir( $content_dir ) || ! wp_is_writable( $content_dir ) ) {
			$errors->warnings->add( 'writeable', sprintf( 'Your content folder in %s is not writeable.', '"' . $content_dir . '"' ) );
		}
		if ( max( intval( @ini_get( 'memory_limit' ) ), intval( WP_MAX_MEMORY_LIMIT ) ) < 128 ) {
			$errors->warnings->add( 'menorylimit', 'Your Memory Limit is ' . size_format( WP_MEMORY_LIMIT * 1048576 ) . ', Mailster recommends at least 128 MB' );
		}

		$errors->error_count   = count( $errors->errors->errors );
		$errors->warning_count = count( $errors->warnings->errors );

		return $errors;

	}


}
