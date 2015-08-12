<?php

$theme = new Theme();
$theme->init(array(
    "theme_name" => "Niizer",
    "theme_slug" => "niizer",
));
if (!isset($content_width)) {
    $content_width = 1140;
}
class Theme
	{
    function init($options)
    {
        $this->constants($options);
        add_action('init', array(
            &$this,
            'language'
        ));
        $this->functions();
        $this->plugins();
        $this->post_types();
        add_action('admin_menu', array(
            &$this,
            'admin_menus'
        ));
        add_action('init', array(
            &$this,
            'add_metaboxes'
        ));
        $this->theme_activated();

        add_action('after_setup_theme', array(
            &$this,
            'supports'
        ));
        add_action('widgets_init', array(
            &$this,
            'widgets'
        ));
    }
    function constants($options){
			define("THEME_DIR", get_template_directory());
      define("THEME_DIR_URI", get_template_directory_uri());
      define("THEME_NAME", $options["theme_name"]);
      define("THEME_SLUG", $options["theme_slug"]);
      define("THEME_FRAMEWORK", THEME_DIR . "/framework");

      define( "UK_JS", get_template_directory_uri() . "/framework/uikit/js" );
      define( "UK_JS_COMPONENT_PATH", get_template_directory() . "/framework/uikit/js/components/" );
      define( "UK_JS_COMPONENT_DIR", get_template_directory_uri() . "/framework/uikit/js/components");
      define( "UK_JS_CORE_PATH", get_template_directory() . '/framework/uikit/js/core/' );
      define( "UK_JS_CORE_DIR", get_template_directory_uri() . '/framework/uikit/js/core/' );

      define( "UK_CSS", get_template_directory_uri() . "/framework/uikit/css" );
      define( "UK_CSS_PATH", get_template_directory() . "/framework/uikit/css/" );
      define( "UK_CSS_DIR", get_template_directory_uri() . "/framework/uikit/css/" );

      define("THEME_STYLES", THEME_DIR_URI . "/stylesheet/css");
      define("THEME_IMAGES", THEME_DIR_URI . "/images");
      define("THEME_JS", THEME_DIR_URI . "/js");
      define("THEME_ACTIONS", THEME_FRAMEWORK . "/actions");
      define("THEME_FUNCTIONS", THEME_FRAMEWORK . "/functions");
      define("THEME_CLASSES", THEME_FRAMEWORK . "/classes");
      define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
      define('THEME_METABOXES', THEME_ADMIN . '/metaboxes');
      define('THEME_ADMIN_POST_TYPES', THEME_ADMIN . '/post-types');
      define('THEME_GENERATORS', THEME_ADMIN . '/generators');
      define('THEME_ADMIN_URI', THEME_DIR_URI . '/framework/admin');
      define('THEME_ADMIN_ASSETS_URI', THEME_DIR_URI . '/framework/admin/assets');
    }
    function functions(){
    	require_once(THEME_FUNCTIONS . "/enqueue-front-scripts.php");
    	require_once(THEME_FUNCTIONS . "/general-functions.php");

    	require_once(THEME_ACTIONS . "/general.php");
    	require_once(THEME_ACTIONS . "/header.php");
      require_once(THEME_ACTIONS . "/post.php");


      require_once(THEME_ACTIONS . "/infinite-scroll.php");


    	if (is_admin()) {
            include_once(THEME_ADMIN . '/general/general-functions.php');
            include_once(THEME_ADMIN . '/general/mega-menu.php');
            include_once(THEME_ADMIN . '/general/icon-library.php');
            include_once(THEME_ADMIN . '/generators/option-generator.php');
            include_once(THEME_ADMIN . '/general/backend-enqueue-scripts.php');
            include_once(THEME_ADMIN . '/admin-panel/masterkey-ajax-calls.php');
        }
    }
    function plugins(){
    }
    function supports(){}
    function widgets(){}
    function post_types(){}
    function language(){}
    function admin_menus(){
        add_menu_page(__('Theme Options', 'mk_framework'), __('Theme Options', 'mk_framework'), 'edit_theme_options', 'masterkey', array(
            &$this,
            '_load_option_page'
        ), 'dashicons-admin-network');

        add_submenu_page( 'themes.php', 'Install Templates', 'Install Templates', 'manage_options', 'demo-importer', array( &$this,'_load_demo_content_page') );
    }
    function add_metaboxes(){
      include_once(THEME_GENERATORS . '/metabox-generator.php');
      include_once(THEME_METABOXES . '/metabox-posts.php');
    }
    function theme_activated(){
    	  if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated'] == 'true') {
          update_option('woocommerce_enable_lightbox', "no");
          wp_redirect(admin_url('admin.php?page=masterkey'));
        }
    }
    function _load_demo_content_page(){}
    function _load_option_page(){
    	$page = include(THEME_ADMIN . '/admin-panel/masterkey.php');
      new mkOptionGenerator($page['name'], $page['options']);
    }

	}


if ( ! function_exists( 'nz_setup' ) ) :

function nz_setup() {

	load_theme_textdomain( 'nz', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'nz' ),
	) );


	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
}
endif; // nz_setup
add_action( 'after_setup_theme', 'nz_setup' );


function nz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nz_content_width', 640 );
}
add_action( 'after_setup_theme', 'nz_content_width', 0 );


function nz_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nz' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nz_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nz_scripts() {

	wp_enqueue_script( 'nz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'nz-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nz_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
