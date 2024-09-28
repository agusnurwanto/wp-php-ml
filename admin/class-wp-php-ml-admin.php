<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/agusnurwanto
 * @since      1.0.0
 *
 * @package    Wp_Php_Ml
 * @subpackage Wp_Php_Ml/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Php_Ml
 * @subpackage Wp_Php_Ml/admin
 * @author     Agus Nurwanto <agusnurwantomuslim@gmail.com>
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

class Wp_Php_Ml_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $functions;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $functions ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->functions = $functions;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Php_Ml_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Php_Ml_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-php-ml-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Php_Ml_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Php_Ml_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-php-ml-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function crb_attach_php_ml_options()
	{
		global $wpdb;

		$llm = $this->functions->generatePage(array(
			'nama_page' => 'Halaman Large Language Model (LLM)',
			'content' => '[halaman_llm]',
			'show_header' => 1,
			'no_key' => 1,
			'post_status' => 'private'
		));
		$halaman_llm = '<li><a target="_blank" href="' . $llm['url'] . '" class="btn btn-primary">' . $llm['title'] . ' </a></li>';

		$basic_options_container = Container::make('theme_options', __('PHP ML Options'))
			->set_page_menu_position(3)
			->add_fields(array(
				Field::make('html', 'crb_php_ml_halaman_terkait')
					->set_html('
					<h4>HALAMAN TERKAIT</h4>
	            	<ol>
	            		'.$halaman_llm.'
	            	</ol>'),
				Field::make('text', 'crb_apikey_php_ml', 'API KEY')
					->set_default_value($this->functions->generateRandomString())
					->set_help_text('Wajib diisi. API KEY digunakan untuk integrasi data.')
			));
	}
}
