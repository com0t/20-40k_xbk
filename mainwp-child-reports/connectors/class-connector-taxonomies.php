<?php
/** MainWP Child Reports taxonomies connector. */

namespace WP_MainWP_Stream;

/**
 * Class Connector_Taxonomies.
 * @package WP_MainWP_Stream
 *
 * @uses \WP_MainWP_Stream\Connector
 */
class Connector_Taxonomies extends Connector {
	/**
	 * Connector slug
	 *
	 * @var string
	 */
	public $name = 'taxonomies';

	/**
	 * Actions registered for this connector.
	 *
	 * @var array
	 */
	public $actions = array(
		'created_term',
		'delete_term',
		'edit_term',
		'edited_term',
	);

	/**
	 * Cache term values before update, used by callback_edit_term/callback_edited_term.
	 *
	 * @var Object
	 */
	public $cached_term_before_update;

	/**
	 * Cache taxonomy labels.
	 *
	 * @var array
	 */
	public $context_labels;

	/**
	 * Register connector in the WP Frontend.
	 *
	 * @var bool
	 */
	public $register_frontend = false;

	/**
	 * Return translated connector label.
	 *
	 * @return string Translated connector label
	 */
	public function get_label() {
		return esc_html__( 'Taxonomies', 'mainwp-child-reports' );
	}

	/**
	 * Return translated action labels.
	 *
	 * @return array Action label translations
	 */
	public function get_action_labels() {
		return array(
			'created' => esc_html__( 'Created', 'mainwp-child-reports' ),
			'updated' => esc_html__( 'Updated', 'mainwp-child-reports' ),
			'deleted' => esc_html__( 'Deleted', 'mainwp-child-reports' ),
		);
	}

	/**
	 * Return translated context labels.
	 *
	 * @return array Context label translations
	 */
	public function get_context_labels() {

		/** @global object $wp_taxonomies WordPress Taxonomies array. */
		global $wp_taxonomies;

		$labels = wp_list_pluck( $wp_taxonomies, 'labels' );

		$this->context_labels = wp_list_pluck( $labels, 'singular_name' );

		add_action( 'registered_taxonomy', array( $this, 'registered_taxonomy' ), 10, 3 );

		return $this->context_labels;
	}

	/**
	 * Add action links to Stream drop row in admin list screen.
	 *
	 * @filter wp_mainwp_stream_action_links_{connector}
	 *
	 * @param array  $links  Previous links registered
	 * @param Record $record Stream record
	 *
	 * @return array Action links
	 */
	public function action_links( $links, $record ) {
		$term = get_term_by( 'term_taxonomy_id', $record->object_id, $record->context ); // wpcom_vip_get_term_by() does not indicate support for `term_taxonomy_id`
		if ( $record->object_id && 'deleted' !== $record->action && $term ) {
			if ( ! is_wp_error( $term ) ) {
				$tax_obj   = get_taxonomy( $term->taxonomy );
				$tax_label = isset( $tax_obj->labels->singular_name ) ? $tax_obj->labels->singular_name : null;

				if ( function_exists( 'wp_get_split_term' ) ) {
					$term_id = wp_get_split_term( $term->term_id, $term->taxonomy );
				}

				$term_id = empty( $term_id ) ? $term->term_id : $term_id;

				// translators: Placeholder refers to a term singular name (e.g. "Tag")
				$links[ sprintf( _x( 'Edit %s', 'Term singular name', 'mainwp-child-reports' ), $tax_label ) ] = get_edit_term_link( $term_id, $term->taxonomy );
				$links[ esc_html__( 'View', 'mainwp-child-reports' ) ] = wp_mainwp_stream_is_vip() ? \wpcom_vip_get_term_link( $term_id, $term->taxonomy ) : get_term_link( $term_id, $term->taxonomy );
			}
		}

		return $links;
	}

	/**
	 * Catch registration of taxonomies after inital loading, so we can cache its labels.
	 *
	 * @action registered_taxonomy
	 *
	 * @param string $taxonomy          Taxonomy slug
	 * @param array|string $object_type Object type or array of object types
	 * @param array|string $args        Array or string of taxonomy registration arguments
	 */
	public function registered_taxonomy( $taxonomy, $object_type, $args ) {
		unset( $object_type );

		$taxonomy_obj = (object) $args;
		$label        = get_taxonomy_labels( $taxonomy_obj )->singular_name;

		$this->context_labels[ $taxonomy ] = $label;

		wp_mainwp_stream_get_instance()->connectors->term_labels['stream_context'][ $taxonomy ] = $label;
	}

	/**
	 * Tracks creation of terms.
	 *
	 * @action created_term
	 *
	 * @param integer $term_id
	 * @param integer $tt_id
	 * @param string $taxonomy
	 */
	public function callback_created_term( $term_id, $tt_id, $taxonomy ) {
		if ( in_array( $taxonomy, $this->get_excluded_taxonomies(), true ) ) {
			return;
		}

		$term           = get_term( $term_id, $taxonomy );
		$term_name      = $term->name;
		$taxonomy_label = strtolower( $this->context_labels[ $taxonomy ] );
		$term_parent    = $term->parent;

		$this->log(
			// translators: Placeholders refer to a term name, and a taxonomy singular label (e.g. "Tags", "Genre")
			_x(
				'"%1$s" %2$s created',
				'1: Term name, 2: Taxonomy singular label',
				'mainwp-child-reports'
			),
			compact( 'term_name', 'taxonomy_label', 'term_id', 'taxonomy', 'term_parent' ),
			$tt_id,
			$taxonomy,
			'created'
		);
	}

	/**
	 * Tracks deletion of taxonomy terms.
	 *
	 * @action delete_term
	 *
	 * @param integer $term_id
	 * @param integer $tt_id
	 * @param string $taxonomy
	 * @param object $deleted_term
	 */
	public function callback_delete_term( $term_id, $tt_id, $taxonomy, $deleted_term ) {
		if ( in_array( $taxonomy, $this->get_excluded_taxonomies(), true ) ) {
			return;
		}

		$term_name      = $deleted_term->name;
		$term_parent    = $deleted_term->parent;
		$taxonomy_label = strtolower( $this->context_labels[ $taxonomy ] );

		$this->log(
			// translators: Placeholders refer to a term name, and a taxonomy singular label (e.g. "Tags", "Genre")
			_x(
				'"%1$s" %2$s deleted',
				'1: Term name, 2: Taxonomy singular label',
				'mainwp-child-reports'
			),
			compact( 'term_name', 'taxonomy_label', 'term_id', 'taxonomy', 'term_parent' ),
			$tt_id,
			$taxonomy,
			'deleted'
		);
	}

	/**
	 * Tracks updates of taxonomy terms.
	 *
	 * @action edit_term
	 *
	 * @param integer $term_id
	 * @param integer $tt_id
	 * @param string $taxonomy
	 */
	public function callback_edit_term( $term_id, $tt_id, $taxonomy ) {
		unset( $tt_id );
		$this->cached_term_before_update = get_term( $term_id, $taxonomy );
	}

    /**
     * Traks edited taxonomy terms.
     *
     * @param $term_id
     * @param $tt_id
     * @param $taxonomy
     */
	public function callback_edited_term( $term_id, $tt_id, $taxonomy ) {
		if ( in_array( $taxonomy, $this->get_excluded_taxonomies(), true ) ) {
			return;
		}

		$term = $this->cached_term_before_update;

		if ( ! $term ) { // For some reason!
			$term = get_term( $term_id, $taxonomy );
		}

		$term_name      = $term->name;
		$taxonomy_label = strtolower( $this->context_labels[ $taxonomy ] );
		$term_parent    = $term->parent;

		$this->log(
			// translators: Placeholders refer to a term name, and a taxonomy singular label (e.g. "Tags", "Genre")
			_x(
				'"%1$s" %2$s updated',
				'1: Term name, 2: Taxonomy singular label',
				'mainwp-child-reports'
			),
			compact( 'term_name', 'taxonomy_label', 'term_id', 'taxonomy', 'term_parent' ),
			$tt_id,
			$taxonomy,
			'updated'
		);
	}

	/**
	 * Constructs list of excluded taxonomies for the Taxonomies connector.
	 *
	 * @return array List of excluded taxonomies
	 */
	public function get_excluded_taxonomies() {
		return apply_filters(
			'wp_mainwp_stream_taxonomies_exclude_taxonomies',
			array(
				'nav_menu',
			)
		);
	}
}
