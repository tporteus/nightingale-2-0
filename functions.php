<?php
/**
 * Nightingale 2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nightingale_2.0
 */

if ( ! function_exists( 'nightingale_2_0_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nightingale_2_0_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Nightingale 2.0, use a find and replace
		 * to change 'nightingale-2-0' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'nightingale-2-0', get_template_directory() . '/languages' );

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
        function register_my_menus() {
            register_nav_menus(
                array(
                    'main-menu' => __( 'Main Menu' ),
                    'footer-menu' => __( 'Extra Menu' )
                )
            );
        }
        add_action( 'init', 'register_my_menus' );

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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'nightingale_2_0_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'nightingale_2_0_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nightingale_2_0_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'nightingale_2_0_content_width', 640 );
}
add_action( 'after_setup_theme', 'nightingale_2_0_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nightingale_2_0_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nightingale-2-0' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'nightingale-2-0' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nightingale_2_0_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nightingale_2_0_scripts() {
	wp_enqueue_style( 'nightingale-2-0-style', get_stylesheet_uri() );

	wp_enqueue_script( 'nightingale-2-0-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'nightingale-2-0-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nightingale_2_0_scripts' );



/**
 * Set the theme colors
 */
add_action( 'after_setup_theme', 'prefix_register_colors' );
function prefix_register_colors() {
    add_theme_support(
        'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'NHS Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_blue',
                'color' => '#005eb8',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_dark_blue',
                'color' => '#003087',
            ),
            array(
                'name'  => esc_html__( 'NHS Bright Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_bright_blue',
                'color' => '#0072ce',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_light_blue',
                'color' => '#41b6e6',
            ),
            array(
                'name'  => esc_html__( 'NHS Mid Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_mid_grey',
                'color' => '#768692',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_light_grey',
                'color' => '#e8edee',
            ),
            array(
                'name'  => esc_html__( 'NHS Purple', 'prefix_textdomain' ),
                'slug' => 'nhs_purple',
                'color' => '#330072',
            ),
            array(
                'name'  => esc_html__( 'NHS Pink', 'prefix_textdomain' ),
                'slug' => 'nhs_pink',
                'color' => '#ae2573',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Purple', 'prefix_textdomain' ),
                'slug' => 'nhs_light_purple',
                'color' => '#704c9c',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Green', 'prefix_textdomain' ),
                'slug' => 'nhs_light_green',
                'color' => '#78be20',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Green', 'prefix_textdomain' ),
                'slug' => 'nhs_dark_green',
                'color' => '#006747',
            ),
            array(
                'name'  => esc_html__( 'NHS Aqua Green', 'prefix_textdomain' ),
                'slug' => 'nhs_aqua_green',
                'color' => '#00a499',
            ),
            array(
                'name'  => esc_html__( 'NHS Black', 'prefix_textdomain' ),
                'slug' => 'nhs_black',
                'color' => '#231f20',
            ),
            array(
                'name'  => esc_html__( 'Emergency Services Red', 'prefix_textdomain' ),
                'slug' => 'emergency_red',
                'color' => '#da291c',
            ),
            array(
                'name'  => esc_html__( 'NHS Yellow', 'prefix_textdomain' ),
                'slug' => 'nhs_yellow',
                'color' => '#fae100',
            ),
            array(
                'name'  => esc_html__( 'NHS Warm Yellow', 'prefix_textdomain' ),
                'slug' => 'nhs_warm_yellow',
                'color' => '#ffb81c',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_grey_dark',
                'color' => '#425563',
            ),
            array(
                'name'  => esc_html__( 'White', 'prefix_textdomain' ),
                'slug' => 'white',
                'color' => '#ffffff',
            ),
        )
    );
}

/**
 * Get the colors formatted for use with Iris, Automattic's color picker
 */
function output_the_colors() {

    // get the colors
    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

    // bail if there aren't any colors found
    if ( !$color_palette )
        return;

    // output begins
    ob_start();

    // output the names in a string
    echo '[';
    foreach ( $color_palette as $color ) {
        echo "'" . $color['color'] . "', ";
    }
    echo ']';

    return ob_get_clean();

}


/**
 * Add the colors into Iris
 */
add_action( 'acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette' );
function gutenberg_sections_register_acf_color_palette() {

    $color_palette = output_the_colors();
    if ( !$color_palette )
        return;

    ?>
    <script type="text/javascript">
        (function( $ ) {
            acf.add_filter( 'color_picker_args', function( args, $field ){
                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = <?php echo $color_palette; ?>
                // return colors
                return args;
            });
        })(jQuery);
    </script>
    <?php
}

/**
 * Enqueue Gutenberg block editor style
 */
function nhsl_gutenberg_editor_styles() {
    wp_enqueue_style( 'nhsl-block-editor-styles', get_theme_file_uri( '/style-gutenburg.css' ), false, '1.0', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'nhsl_gutenberg_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Main menu (using Walker Nav Menu).
 */
require get_template_directory() . '/inc/walker-menu.php';

/**
 * Breadcrumb element.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
