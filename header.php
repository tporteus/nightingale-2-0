<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	wp_head();
	flush();
	?>
</head>
<body <?php body_class( 'js-enabled' ); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nightingale' ); ?></a>
<?php

$header_layout = get_theme_mod( 'logo_type', 'transactional' );
$header_colour = get_theme_mod( 'header_styles', 'normal' );

if ( 'normal' !== $header_colour ) {
	$header_colour_text = ' nhsuk-header--white';
} else {
	$header_colour_text = '';
}
echo '<header class="nhsuk-header nhsuk-header--' . esc_html( $header_layout . $header_colour_text ) . '" role="banner">';

get_template_part( 'partials/header--' . $header_layout );
?>

<?php
$menu_locations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php).

$topmenu_args = array(
	'menu'            => 'main-menu',
	'menu_class'      => 'nhsuk-header__navigation-list',
	'menu_id'         => 'menu-menu-top-menu',
	'container'       => false,
	'container_class' => '',
	'container_id'    => '',
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'echo'            => true,
	'depth'           => 1,
	'walker'          => '',
	'theme_location'  => 'main-menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'item_spacing'    => 'preserve',
);
?>
<nav class="nhsuk-header__navigation" id="header-navigation" role="navigation" aria-label="Primary navigation" aria-labelledby="label-navigation">
	<div class="nhsuk-width-container">
		<p class="nhsuk-header__navigation-title"><span id="label-navigation">Menu</span>
			<button class="nhsuk-header__navigation-close" id="close-menu">
				<svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
				</svg>
				<span class="nhsuk-u-visually-hidden">Close menu</span>
			</button>
		</p>
		<?php
		wp_nav_menu( $topmenu_args );
		?>
	</div>
</nav>
</header>
<?php echo nightingale_breadcrumb(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<div id="content" class="nhsuk-width-container nhsuk-width-container--full">
	<main class="nhsuk-main-wrapper nhsuk-main-wrapper--no-padding" id="maincontent">
		<div id="contentinner" class="nhsuk-width-container">
			<?php flush(); ?>

