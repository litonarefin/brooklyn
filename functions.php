<?php
/**
 * Brooklyn functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Brooklyn
 */

define( 'BROOKLYN_WP', wp_get_theme()->get( 'Name' ));
define( 'BROOKLYN_VER', wp_get_theme()->get( 'Version' ));
define( 'BROOKLYN_CSS', get_template_directory_uri().'/assets/css/');
define( 'BROOKLYN_JS', get_template_directory_uri().'/assets/js/');
define( 'BROOKLYN_PATH', get_template_directory());
define( 'BROOKLYN_THEME_URI', get_template_directory_uri());
define( 'AJAX_URL', esc_url_raw( admin_url('admin-ajax.php')));

if ( ! function_exists( 'brooklyn_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function brooklyn_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Brooklyn, use a find and replace
		 * to change 'brooklyn' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'brooklyn', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'main-menu' => esc_html__( 'Main Menu', 'brooklyn' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'brooklyn_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'brooklyn_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function brooklyn_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'brooklyn_content_width', 640 );
}
add_action( 'after_setup_theme', 'brooklyn_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function brooklyn_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'brooklyn' ),
			'id'            => 'blog-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'brooklyn' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'brooklyn_widgets_init' );


// Google Fonts
function brooklyn_google_fonts_url() {
    $font_url = '';
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'brooklyn' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Montserrat: 300,400,500,600,700,800,900&display=swap' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}




/**
 * Enqueue scripts and styles.
 */
function brooklyn_scripts() {

	//CSS
	wp_enqueue_style( 'brooklyn-style', get_stylesheet_uri(), array(), BROOKLYN_VER );
	wp_enqueue_style( 'bootstrap', BROOKLYN_CSS . 'bootstrap.min.css');
	wp_enqueue_style( 'simple-line-icons', BROOKLYN_CSS . 'simple-line-icons.css');
	wp_enqueue_style( 'simple-line-icons', BROOKLYN_CSS . 'all.min.css');
	wp_enqueue_style( 'font-awesome', BROOKLYN_CSS . 'font-awesome.min.css');
	wp_enqueue_style( 'brooklyn-themes', BROOKLYN_CSS . 'themes.css');
	wp_enqueue_style( 'brooklyn-google-fonts', brooklyn_google_fonts_url() );

	wp_style_add_data( 'brooklyn-style', 'rtl', 'replace' );


	//JS
	wp_enqueue_script( 'popper', BROOKLYN_JS . 'popper.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'bootstrap', BROOKLYN_JS . 'bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'brooklyn-scripts', BROOKLYN_JS . 'scripts.js', array('jquery'), '', true );
	

	wp_enqueue_script( 'brooklyn-navigation', BROOKLYN_JS . 'navigation.js', array(), BROOKLYN_VER, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'brooklyn_scripts' );



// Includes Files
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
require_once get_template_directory().'/inc/class-wp-bootstrap-navwalker.php';
require get_template_directory()  . '/inc/breadcrumb-trail.php';
require_once( get_template_directory() . '/admin/admin.php');

if ( defined( 'JETPACK__VERSION' ) ) { 
	require get_template_directory() . '/inc/jetpack.php'; 
}
if ( class_exists( 'WooCommerce' ) ) { 
	require get_template_directory() . '/inc/woocommerce.php'; 
}
if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	require_once( get_template_directory()  . '/inc/class-tgm-plugin-activation.php');
	require_once( get_template_directory()  . '/inc/required-plugins.php');
}


