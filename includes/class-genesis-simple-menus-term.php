<?php
/**
 * Genesis Simple Menus
 *
 * @package StudioPress\GenesisSimpleMenus
 */

/**
 * Term Settings.
 */
class Genesis_Simple_Menus_Term {

	/**
	 * The Menu to use.
	 *
	 * @var null
	 */
	public $menu = null;

	/**
	 * The meta key for the user specified primary nav menu.
	 *
	 * @var string
	 */
	public $primary_key = '_gsm_primary';

	/**
	 * The meta key for the user specified secondary nav menu.
	 *
	 * @var string
	 */
	public $secondary_key = '_gsm_secondary';

	/**
	 * The supported taxonomies.
	 *
	 * @var array
	 */
	public $taxonomies;

	/**
	 * Initialize.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function init() {

		// Add fields to the term edit form.
		add_action( 'admin_init', array( $this, 'add_edit_form' ) );

	}

	/**
	 * Add fields to the term edit form. Added to public taxonomies only, by default.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function add_edit_form() {

		$_taxonomies = get_taxonomies( array(
			'show_ui' => true,
			'public' => true,
		) );

		/**
		 * The supported taxonomies.
		 *
		 * An array of supported taxonomies. All public taxonomies, by default.
		 *
		 * @since  0.1.0
		 *
		 * @param  array $taxonomies The supported taxonomies.
		 *
		 * @return void
		 */
		$this->taxonomies = apply_filters( 'genesis_simple_menus_taxonomies', array_keys( $_taxonomies ) );

		if ( ! is_array( $this->taxonomies ) ) {
			return;
		}

		foreach ( $this->taxonomies as $tax ) {
			add_action( "{$tax}_edit_form", array( $this, 'term_edit_form' ), 9, 2 );
		}

	}

	/**
	 * The edit form fields markup.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $term     The term ID.
	 * @param  string $taxonomy Current taxonomy.
	 *
	 * @return void
	 */
	public function term_edit_form( $term, $taxonomy ) {

		require_once( Genesis_Simple_Menus()->plugin_dir_path . 'includes/views/term-edit-field.php' );

	}

}
