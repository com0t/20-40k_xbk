<?php
/**
 * Alert Type abstract class.
 *
 * Used to register new Alert types.
 *
 * @package WP_MainWP_Stream
 */

namespace WP_MainWP_Stream;

/**
 * Class Alert_Type
 *
 * @package WP_MainWP_Stream
 */
abstract class Alert_Type {

	/**
	 * Hold the Plugin class
	 *
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Unique identifier.
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Alert_Type constructor.
	 *
	 * Run each time the class is called.
	 *
	 * @param Plugin $plugin Plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 *  Alert recipients about the new record
	 *
	 * @param int   $record_id Record ID.
	 * @param array $recordarr Record details.
	 * @param array $options Alert options.
	 */
	abstract public function alert( $record_id, $recordarr, $options );

	/**
	 * Display settings form for configuration of individual alerts
	 *
	 * @param Alert $alert Alert currently being worked on.
	 */
	public function display_fields( $alert ) {
		// Implementation optional, but recommended
	}

	/**
	 * Process settings form for configuration of individual alerts
	 *
	 * @param Alert $alert Alert currently being worked on.
	 */
	public function save_fields( $alert ) {
		// Implementation optional, but recommended
	}

	/**
	 * Allow connectors to determine if their dependencies are satisfied or not
	 *
	 * @return bool
	 */
	public function is_dependency_satisfied() {
		// Implementation optional, but recommended
		return true;
	}
}
