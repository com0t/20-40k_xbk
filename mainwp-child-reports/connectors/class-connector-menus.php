<?php
/** MainWP Child Reports Menus Connector. */

namespace WP_MainWP_Stream;

/**
 * Class Connector_Menus.
 * @package WP_MainWP_Stream
 *
 * @uses \WP_MainWP_Stream\Connector
 */
class Connector_Menus extends Connector {
	/**
	 * Connector slug.
	 *
	 * @var string
	 */
	public $name = 'menus';

	/**
	 * Actions registered for this connector.
	 *
	 * @var array
	 */
	public $actions = array(
		'wp_create_nav_menu',
		'wp_update_nav_menu',
		'delete_nav_menu',
	);

	/**
	 * Register connector in the WP Frontend.
	 *
	 * @var bool
	 */
	public $register_frontend = false;

	/**
	 * Return translated connector label
	 *
	 * @return string Translated connector label
	 */
	public function get_label() {
		return esc_html__( 'Menus', 'mainwp-child-reports' );
	}

	/**
	 * Return translated action labels.
	 *
	 * @return array Action label translations
	 */
	public function get_action_labels() {
		return array(
			'created'    => esc_html__( 'Created', 'mainwp-child-reports' ),
			'updated'    => esc_html__( 'Updated', 'mainwp-child-reports' ),
			'deleted'    => esc_html__( 'Deleted', 'mainwp-child-reports' ),
			'assigned'   => esc_html__( 'Assigned', 'mainwp-child-reports' ),
			'unassigned' => esc_html__( 'Unassigned', 'mainwp-child-reports' ),
		);
	}

	/**
	 * Return translated context labels.
	 *
	 * @return array Context label translations
	 */
	public function get_context_labels() {
		$labels = array();
		$menus  = get_terms(
			'nav_menu', array(
				'hide_empty' => false,
			)
		);

		foreach ( $menus as $menu ) {
			$slug            = sanitize_title( $menu->name );
			$labels[ $slug ] = $menu->name;
		}

		return $labels;
	}

    /**
     * Register MainWP Child Reports stylesheet.
     *
     * @uses \WP_MainWP_Stream\Connector::register()
     */
	public function register() {
		parent::register();

		add_action( 'update_option_theme_mods_' . get_option( 'stylesheet' ), array( $this, 'callback_update_option_theme_mods' ), 10, 2 );
	}

	/**
	 * Add action links to Stream drop row in admin list screen.
	 *
	 * @filter wp_mainwp_stream_action_links_{connector}
	 *
	 * @param  array  $links     Previous links registered
	 * @param  object $record    Stream record
	 *
	 * @return array             Action links
	 */
	public function action_links( $links, $record ) {
		if ( $record->object_id ) {
			$menus    = wp_get_nav_menus();
			$menu_ids = wp_list_pluck( $menus, 'term_id' );

			if ( in_array( $record->object_id, $menu_ids, true ) ) {
				$links[ esc_html__( 'Edit Menu', 'mainwp-child-reports' ) ] = admin_url( 'nav-menus.php?action=edit&menu=' . $record->object_id );
			}
		}

		return $links;
	}

	/**
	 * Tracks creation of menus.
	 *
	 * @action wp_create_nav_menu
	 *
	 * @param int $menu_id
	 * @param array $menu_data
	 */
	public function callback_wp_create_nav_menu( $menu_id, $menu_data ) {
		$name = $menu_data['menu-name'];

		$this->log(
			// translators: Placeholder refers to a menu name (e.g. "Primary Menu")
			__( 'Created new menu "%s"', 'mainwp-child-reports' ),
			compact( 'name', 'menu_id' ),
			$menu_id,
			sanitize_title( $name ),
			'created'
		);
	}

	/**
	 * Tracks menu updates.
	 *
	 * @action wp_update_nav_menu
	 *
	 * @param int $menu_id
	 * @param array $menu_data
	 */
	public function callback_wp_update_nav_menu( $menu_id, $menu_data = array() ) {
		if ( empty( $menu_data ) ) {
			return;
		}

		$name = $menu_data['menu-name'];

		$this->log(
			// translators: Placeholder refers to a menu name (e.g. "Primary Menu")
			_x( 'Updated menu "%s"', 'Menu name', 'mainwp-child-reports' ),
			compact( 'name', 'menu_id', 'menu_data' ),
			$menu_id,
			sanitize_title( $name ),
			'updated'
		);
	}

	/**
	 * Tracks menu deletion.
	 *
	 * @action delete_nav_menu
	 *
	 * @param object $term
	 * @param int $tt_id
	 * @param object $deleted_term
	 */
	public function callback_delete_nav_menu( $term, $tt_id, $deleted_term ) {
		unset( $tt_id );

		$name    = $deleted_term->name;
		$menu_id = $term->term_id;

		$this->log(
			// translators: Placeholder refers to a menu name (e.g. "Primary Menu")
			_x( 'Deleted "%s"', 'Menu name', 'mainwp-child-reports' ),
			compact( 'name', 'menu_id' ),
			$menu_id,
			sanitize_title( $name ),
			'deleted'
		);
	}

	/**
	 * Track assignment to menu locations.
	 *
	 * @action update_option_theme_mods_{$stylesheet}
	 *
	 * @param array $old
	 * @param array $new
	 */
	public function callback_update_option_theme_mods( $old, $new ) {
		// Disable if we're switching themes
		if ( did_action( 'after_switch_theme' ) ) {
			return;
		}

		$key = 'nav_menu_locations';

		if ( ! isset( $new[ $key ] ) ) {
			return; // Switching themes ?
		}

		if ( $old[ $key ] === $new[ $key ] ) {
			return;
		}

		$locations = get_registered_nav_menus();
		$old_value = (array) $old[ $key ];
		$new_value = (array) $new[ $key ];
		$changed   = array_diff_assoc( $old_value, $new_value ) + array_diff_assoc( $new_value, $old_value );

		if ( ! $changed ) {
			return;
		}

		foreach ( $changed as $location_id => $menu_id ) {
			$location = $locations[ $location_id ];

			if ( empty( $new[ $key ][ $location_id ] ) ) {
				$action  = 'unassigned';
				$menu_id = isset( $old[ $key ][ $location_id ] ) ? $old[ $key ][ $location_id ] : 0;
				// translators: Placeholders refer to a menu name, and a theme location (e.g. "Primary Menu", "primary_nav")
				$message = _x(
					'"%1$s" has been unassigned from "%2$s"',
					'1: Menu name, 2: Theme location',
					'mainwp-child-reports'
				);
			} else {
				$action  = 'assigned';
				$menu_id = isset( $new[ $key ][ $location_id ] ) ? $new[ $key ][ $location_id ] : 0;
				// translators: Placeholders refer to a menu name, and a theme location (e.g. "Primary Menu", "primary_nav")
				$message = _x(
					'"%1$s" has been assigned to "%2$s"',
					'1: Menu name, 2: Theme location',
					'mainwp-child-reports'
				);
			}

			$menu = get_term( $menu_id, 'nav_menu' );

			if ( ! $menu || is_wp_error( $menu ) ) {
				continue; // This is a deleted menu
			}

			$name = $menu->name;

			$this->log(
				$message,
				compact( 'name', 'location', 'location_id', 'menu_id' ),
				$menu_id,
				sanitize_title( $name ),
				$action
			);
		}
	}
}
