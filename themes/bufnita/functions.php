<?php
/**
 * bufnita functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package bufnita
 */

if ( ! function_exists( 'bufnita_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bufnita_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bufnita, use a find and replace
	 * to change 'bufnita' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'bufnita', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'bufnita' ),
		'footer' => esc_html__( 'Footer Menu', 'bufnita_footer' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'bufnita_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // bufnita_setup
add_action( 'after_setup_theme', 'bufnita_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bufnita_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bufnita_content_width', 640 );
}
add_action( 'after_setup_theme', 'bufnita_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bufnita_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bufnita' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'bufnita_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bufnita_scripts() {
	wp_enqueue_style( 'bufnita-style', get_stylesheet_uri() );

	wp_enqueue_script( 'bufnita-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'bufnita-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bufnita_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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

require get_template_directory() . '/inc/aq_resizer.php';

require get_template_directory() . '/inc/custom_post_types.php';

require_once(get_template_directory() . '/inc/custom-contact-options-page.php');

remove_action( 'template_redirect', 'wp_shortlink_header', 11 );

add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email )
{
    return "contact@bufnitadintei.ro";
}

add_filter( 'wp_mail_from_name', 'my_mail_from_name' );
function my_mail_from_name( $name )
{
    return "Contact";
}

add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


function processing_mailchimp_registration($email) {
	include(ABSPATH . 'wp-content/plugins/buf_rum_newsletter/MCAPI.php');
	$buf_rum_options = get_option( 'buf_rum_options', null );
	$mailchimp_api_key = isset($buf_rum_options['mailchimp_api_key']) ? $buf_rum_options['mailchimp_api_key'] : null;
	$mailchimp_list_id = isset($buf_rum_options['mailchimp_list_id']) ? $buf_rum_options['mailchimp_list_id'] : null;
	
	$obj = new MCAPI($mailchimp_api_key);
	$merge_vars = array();
	//subscribe la noul user;
	$retval = $obj->listSubscribe( $mailchimp_list_id, $email, $merge_vars, 'html', false, false, false, false );
	$buf_rum_mc_response_data = "";
	$error_code = 0;
	//get internal MailChimp user id;
	if ($obj->errorCode) {
		$error_code = $obj->errorCode;
	}
	$buf_rum_mc_response_data = $retval ? $obj->listMemberInfo($mailchimp_list_id, array($email)) : null;
	return array('data' => $buf_rum_mc_response_data, 'error_code' => $error_code);
}

function buf_rum_start_session() {
    if(!session_id()) {
        session_start();
    }
	if(! isset($_SESSION['first_visit_since'])) {
		$_SESSION['first_visit_since'] = time();
	}
}
add_action('init', 'buf_rum_start_session', 1);

function teacher_registration_widget_can_be_displayed() {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $is_plugin_active = is_plugin_active('buf_on_off_teacher_widget/buf_on_off_teacher_widget.php');
    if ($is_plugin_active) {
        $buf_tws_options = get_option('buf_tws_options', null);
        $display_widget = (isset($buf_tws_options['teacher_registration_widget_status']) && $buf_tws_options['teacher_registration_widget_status'] == 'active') ? true : false;
        //echo "<br/>Plugin status: " . $display_widget;
        return $display_widget;
    }
    return false;
}