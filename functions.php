<?php
/**
 * TFS-Portal functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TFS-Portal
 */

/**
 * TFS-Portal only works if the REST API is available
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/compat-warnings.php';
	return;
}

if ( ! defined( 'TFS_PORTAL_VERSION' ) ) {
	define( 'TFS_PORTAL_VERSION', '0.0.1-alpha' );
}

if ( ! defined( 'TFS_PORTAL_APP' ) ) {
	define( 'TFS_PORTAL_APP', 'tfs-portal-react-bundle-js' );
}


// import stylesheet
function tfs_portal_resources () 
{
	// main
	wp_enqueue_style('style', get_stylesheet_uri());

	wp_enqueue_style( 'tfs-portal-style', get_template_directory_uri() . '/build/css/bundle.css', array(), TFS_PORTAL_VERSION );

	wp_enqueue_script( TFS_PORTAL_APP, get_template_directory_uri() . '/build/js/bundle.js', array(), TFS_PORTAL_VERSION, true );

	// Generate CSS string with initial CSS variables
	$cssVariables = sprintf(
		'.css-variables {
			--base-color: %s;
			--highlight-color: %s;
		}', 
			get_option('base_color'),
			get_option('highlight_color')
	);

	wp_add_inline_style( 'style', $cssVariables );

	// Generate JSON data with initial portal settings
	$url = trailingslashit( home_url() );
	$path = trailingslashit( wp_parse_url( $url )['path'] );

	$front_page_slug = false;
	$blog_page_slug = false;
	if ( 'posts' !== get_option( 'show_on_front' ) ) {
		$front_page_id = get_option( 'page_on_front' );
		$front_page = get_post( $front_page_id );
		if ( $front_page->post_name ) {
			$front_page_slug = $front_page->post_name;
		}

		$blog_page_id = get_option( 'page_for_posts' );
		$blog_page = get_post( $blog_page_id );
		if ( $blog_page->post_name ) {
			$blog_page_slug = $blog_page->post_name;
		}
	}

	$user_id = get_current_user_id();

	$tfs_portal_settings = sprintf(
		'var SiteSettings = %s;',
		wp_json_encode( array(
			'endpoint' => esc_url_raw( $url ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
			'themeURL' => get_bloginfo('template_directory'),
			'user' => $user_id,
			'userDisplay' => $user_id ? get_the_author_meta( 'display_name', $user_id ) : '',
			'frontPage' => array(
				'page' => $front_page_slug,
				'blog' => $blog_page_slug,
			),
			'URL' => array(
				'base' => esc_url_raw( $url ),
				'path' => $path,
			),
			'meta' => array(
				'title' => get_bloginfo( 'name', 'display' ),
				'description' => get_bloginfo( 'description', 'display' ),
			),
		) )
	);
	wp_add_inline_script( TFS_PORTAL_APP , $tfs_portal_settings, 'before' );
}
add_action('wp_enqueue_scripts', 'tfs_portal_resources');

// theme setup
function tfs_portal_theme_setup()
{
	// navigation menus
	register_nav_menus(array(
	  'menu-top-bar' => __('top-bar-menu'),
	  'menu-side-list' => __('side-bar-menu'),
	));

	// add featured image support
	add_theme_support('post-thumbnails');
	// define image sizes
	set_post_thumbnail_size( 200, 150, true );
	// add post format support
	add_theme_support('post-formats', array('aside'));
}
add_action('after_setup_theme', 'tfs_portal_theme_setup');

// use post's front-end styles in TinyMCE text editor
function tfs_portal_theme_add_editor_styles() {
	add_editor_style( 'build/css/main.min.css' );
}
add_action( 'admin_init', 'tfs_portal_theme_add_editor_styles' );

// disable Guttemberg - disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);
// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);

// Setup administration
require get_template_directory() . '/inc/admin/index.php';

// Setting up routing for the JS router
require get_template_directory() . '/inc/permalinks.php';

// remove WordPress emojis
require get_template_directory() . '/inc/remove_wp_emoji.php';