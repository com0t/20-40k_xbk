<?php
/** MainWP Child Reports export. */
namespace WP_MainWP_Stream;

/**
 * Class Export.
 * @package WP_MainWP_Stream
 */
class Export {
	/**
	 * Hold Plugin class
	 *
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Hold registered exporters
	 *
	 * @var array
	 */
	protected $exporters = array();

	/**
	 * Export constructor
	 *
	 * Run each time the class is called.
	 *
	 * @param Plugin $plugin The plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;

		if ( 'wp_mainwp_stream' === wp_mainwp_stream_filter_input( INPUT_GET, 'page' ) ) {
			add_action( 'admin_init', array( $this, 'render_download' ) );
			add_action( 'wp_mainwp_stream_record_actions_menu', array( $this, 'actions_menu_export_items' ) );
			$this->register_exporters();
		}
	}

	/**
	 * Outputs download file to user based on selected exporter
	 *
	 * @return void
	 */
	public function render_download() {
		$nonce = wp_mainwp_stream_filter_input( INPUT_GET, 'stream_record_actions_nonce' );
		if ( ! wp_verify_nonce( $nonce, 'stream_record_actions_nonce' ) ) {
			return;
		}

		$action = wp_mainwp_stream_filter_input( INPUT_GET, 'record-actions' );
		if ( strpos( $action, 'export-' ) !== 0 ) {
			return;
		}

		$output_type = str_replace( 'export-', '', $action );
		if ( ! array_key_exists( $output_type, $this->get_exporters() ) ) {
			return;
		}

		$this->plugin->admin->register_list_table();
		$list_table = $this->plugin->admin->list_table;
		$list_table->prepare_items();
		add_filter( 'mainwp_stream_records_per_page', array( $this, 'disable_paginate' ) );
		add_filter( 'wp_mainwp_stream_list_table_columns', array( $this, 'expand_columns' ), 10, 1 );

		$records = $list_table->get_records();
		$columns = $list_table->get_columns();
		$output  = array();
		foreach ( $records as $item ) {
			$output[] = $this->build_record( $item, $columns );
		}

		$exporters = $this->get_exporters();
		$exporter  = $exporters[ $output_type ];
		$exporter->output_file( $output, $columns );
	}

	/**
	 * Add Export options to record actions menu.
     *
	 * @param array $action_menu_items Action menu items.
     *
	 * @return array $action_menu_items Return Action Menu Items.
     *
     * @uses \WP_MainWP_Stream\Author::get_exporters()
	 */
	public function actions_menu_export_items( $action_menu_items ) {
		foreach ( $this->get_exporters() as $exporter ) {
			$action = 'export-' . $exporter->slug;
			// translators: Placeholder refers to an export format (e.g. "CSV").
			$action_menu_items[ $action ] = sprintf( __( 'Export as %s', 'mainwp-child-reports' ), $exporter->name );
		}

		return $action_menu_items;
	}

	/**
	 * Extracts data from Records
	 *
	 * @param array $item Post to extract data from.
	 * @param array $columns Columns being extracted.
	 *
	 * @return array Numerically-indexed array with extracted data.
	 *
	 * @uses \WP_MainWP_Stream\Author
	 * @uses \WP_MainWP_Stream\Record
	 */
	public function build_record( $item, $columns ) {
		$record = new Record( $item );

		$row_out = array();
		foreach ( array_keys( $columns ) as $column_name ) {
			switch ( $column_name ) {
				case 'date':
					$created                 = date( 'Y-m-d H:i:s', strtotime( $record->created ) );
					$row_out[ $column_name ] = get_date_from_gmt( $created, 'Y/m/d h:i:s A' );
					break;

				case 'summary':
					$row_out[ $column_name ] = $record->summary;
					break;

				case 'user_id':
					$user                    = new Author( (int) $record->user_id, (array) $record->user_meta );
					$row_out[ $column_name ] = $user->get_display_name();
					break;

				case 'connector':
					$row_out[ $column_name ] = $record->connector;
					break;

				case 'context':
					$row_out[ $column_name ] = $record->context;
					break;

				case 'action':
					$row_out[ $column_name ] = $record->{$column_name};
					break;

				case 'blog_id':
					$row_out[ $column_name ] = $record->blog_id;
					break;

				case 'ip':
					$row_out[ $column_name ] = $record->{$column_name};
					break;
			}
		}

		return $row_out;
	}

	/**
	 * Increase pagination limit for CSV Output
	 *
	 * @param int $records_per_page Old limit for records_per_page.
	 * @return int
	 */
	public function disable_paginate( $records_per_page ) {
		return 10000;
	}

	/**
	 * Expand columns for CSV Output
	 *
	 * @param array $columns Columns currently registered to the list table being exported.
	 * @return array New columns for exporting.
	 */
	public function expand_columns( $columns ) {
		$new_columns = array(
			'date'      => $columns['date'],
			'summary'   => $columns['summary'],
			'user_id'   => $columns['user_id'],
			'connector' => __( 'Connector', 'mainwp-child-reports' ),
			'context'   => $columns['context'],
			'action'    => $columns['action'],
			'ip'        => $columns['ip'],
		);

		if ( is_multisite() && is_plugin_active_for_network( $this->plugin->locations['plugin'] ) ) {
			$new_columns['blog_id'] = __( 'Blog ID', 'mainwp-child-reports' );
		}

		return $new_columns;
	}

	/**
	 * Registers all available exporters
	 *
	 * @return void
	 */
	public function register_exporters() {
		$exporters = array(
			'csv',
			'json',
		);

		$classes = array();
		foreach ( $exporters as $exporter ) {
			include_once $this->plugin->locations['dir'] . '/exporters/class-exporter-' . $exporter . '.php';
			$class_name = sprintf( '\WP_MainWP_Stream\Exporter_%s', str_replace( '-', '_', $exporter ) );
			if ( ! class_exists( $class_name ) ) {
				continue;
			}
			$class = new $class_name();
			if ( ! property_exists( $class, 'slug' ) ) {
				continue;
			}
			$classes[ $class->slug ] = $class;
		}

		/**
		 * Allows for adding additional exporters via classes that extend Exporter.
		 *
		 * @param array $classes An array of Exporter objects. In the format exporter_slug => Exporter_Class()
		 */
		$this->exporters = apply_filters( 'wp_mainwp_stream_exporters', $classes );

		// Ensure that all exporters extend Exporter
		foreach ( $this->exporters as $key => $exporter ) {
			if ( ! $this->is_valid_exporter( $exporter ) ) {
				unset( $this->exporters[ $key ] );
			}
		}
	}

	/**
	 * Checks whether an exporter class is valid
	 *
	 * @param Exporter $exporter The class to check.
	 * @return bool
	 *
	 * @uses \WP_MainWP_Stream\Exporter
	 */
	public function is_valid_exporter( $exporter ) {
		if ( ! is_a( $exporter, 'WP_MainWP_Stream\Exporter' ) ) {
			return false;
		}

		if ( ! method_exists( $exporter, 'is_dependency_satisfied' ) || ! $exporter->is_dependency_satisfied() ) {
			return false;
		}

		return true;
	}


	/**
	 * Returns an array with all available exporters
	 *
	 * @return array
	 */
	public function get_exporters() {
		return $this->exporters;
	}
}
