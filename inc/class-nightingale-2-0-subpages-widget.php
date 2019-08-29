<?php
/**
 * Plugin Name: BE Subpages Widget
 * Plugin URI: http://www.billerickson.net
 * Description: Lists subpages of the current section
 * Version: 1.7
 * Author: Bill Erickson
 * License: GPLv2
 * Modified by Tony Blacker, July 2019 to include inside Nightingale 2.0 Theme as a self contained widget so it can be auto deployed on theme activation
 * All nightingale_2_0_ functions renamed to nightingale_ to avoid clashes if BE Subpages widget is also installed
 *
 * @package Nightingale_2.0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Register Widget
 */
function nightingale_2_0_subpages_load_widgets() {
	register_widget( 'Nightingale_2_0_Subpages_Widget' );
}

add_action( 'widgets_init', 'nightingale_2_0_subpages_load_widgets' );

/**
 * Subpages Widget Class
 *
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class Nightingale_2_0_Subpages_Widget extends WP_Widget {

	/**
	 * Constructor
	 *
	 * @return void
	 **/
	public function __construct() {
		load_plugin_textdomain( 'nightingale-2-0', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		$widget_ops = array(
			'classname'   => 'widget_subpages',
			'description' => __( 'Lists current section subpages', 'nightingale-2-0' ),
		);
		parent::__construct( 'subpages-widget', __( 'Subpages Widget', 'nightingale-2-0' ), $widget_ops );
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array $args , Global arguments to pull in.
	 * @param array $instance , this specific item.
	 *
	 * @return void Echoes it's output
	 **/
	public function widget( $args, $instance ) {

		// Only run on hierarchical post types.
		$post_types = get_post_types( array( 'hierarchical' => true ) );
		if ( ! is_singular( $post_types ) && ! apply_filters( 'nightingale_2_0_subpages_widget_display_override', false ) ) {
			return;
		}

		// Find top level parent and create path to it.
		global $post;
		$nightingale_2_0_post = apply_filters( 'nightingale_2_0_subpages_widget_override_post', $post );
		$parents              = array_reverse( get_ancestors( $nightingale_2_0_post->ID, 'page' ) );
		$parents[]            = $nightingale_2_0_post->ID;
		$parents              = apply_filters( 'nightingale_2_0_subpages_widget_parents', $parents );

		// Build a menu listing top level parent's children.
		$subargs     = array(
			'child_of'    => $parents[0],
			'parent'      => $parents[0],
			'sort_column' => 'menu_order',
			'post_type'   => get_post_type(),
		);
		$depth    = 1;
		$subpages = get_pages( apply_filters( 'nightingale_2_0_subpages_widget_args', $subargs, $depth ) );

		// If there are pages, display the widget.
		if ( empty( $subpages ) ) {
			return;
		}

		echo $args['before_widget'];

		global $nightingale_2_0_subpages_is_first;
		$nightingale_2_0_subpages_is_first = true;

		// Build title.
		$title = esc_attr( $instance['title'] );
		if ( 1 === $instance['title_from_parent'] ) {
			$title = apply_filters( 'nightingale_2_0_subpages_widget_title', get_the_title( $parents[0] ) );
			if ( 1 === $instance['title_link'] ) {
				$title = '<a href="' . esc_url( get_permalink( $parents[0] ) ) . '">' . esc_html( $title ) . '</a>';
			}
		}

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		if ( ! isset( $instance['deep_subpages'] ) ) {
			$instance['deep_subpages'] = 0;
		}

		if ( ! isset( $instance['nest_subpages'] ) ) {
			$instance['nest_subpages'] = 0;
		}

		// Print the tree.
		$this->build_subpages( $subpages, $parents, $instance['deep_subpages'], $depth, $instance['nest_subpages'] );

		echo $args['after_widget'];
	}

	/**
	 * Build the Subpages
	 *
	 * @param array $subpages  array of post objects.
	 * @param array $parents  array of parent IDs.
	 * @param bool  $deep_subpages  whether to include current page's subpages.
	 * @param int   $depth  how deep down the navigation tree from current level do we want to go.
	 * @param bool  $nest_subpages  do we want subpages nested, or just top level showing.
	 *
	 * @return string $output
	 */
	public function build_subpages( $subpages, $parents, $deep_subpages = 0, $depth = 1, $nest_subpages = 0 ) {
		if ( empty( $subpages ) ) {
			return;
		}

		global $post, $nightingale_2_0_subpages_is_first;
		// Build the page listing.
		echo '<ul>';
		foreach ( $subpages as $subpage ) {
			$class = array();

			// Unique Identifier.
			$class[] = 'menu-item-' . $subpage->ID;

			// Set special class for current page.
			if ( $subpage->ID === $post->ID ) {
				$class[] = 'widget_subpages__active';
			}

			// First menu item.
			if ( $nightingale_2_0_subpages_is_first ) {
				$class[] .= 'first-menu-item';
			}
			$nightingale_2_0_subpages_is_first = false;

			$class = apply_filters( 'nightingale_2_0_subpages_widget_class', $class, $subpage );
			$class = ! empty( $class ) ? ' class="' . implode( ' ', $class ) . '"' : '';

			echo '<li' . esc_attr( $class ) . '><a href="' . esc_url( get_permalink( $subpage->ID ) ) . '">' . esc_html( apply_filters( 'nightingale_2_0_subpages_page_title', $subpage->post_title, $subpage ) ) . '</a>';
			// If nesting supress the closing li.
			if ( ! $nest_subpages ) {
				echo '</li>';
			}

			do_action( 'nightingale_2_0_subpages_widget_menu_extra', $subpage, $class );

			// Check if the subpage is in parent tree to go deeper.
			if ( $deep_subpages && in_array( $subpage->ID, $parents, true ) ) {
				$args         = array(
					'child_of'    => $subpage->ID,
					'parent'      => $subpage->ID,
					'sort_column' => 'menu_order',
					'post_type'   => get_post_type(),
				);
				$deeper_pages = get_pages( apply_filters( 'nightingale_2_0_subpages_widget_args', $args, $depth ) );
				$depth ++;
				$this->build_subpages( $deeper_pages, $parents, $deep_subpages, $depth, $nest_subpages );
			}
			// If li was surpressed for nesting echo it now.
			if ( $nest_subpages ) {
				echo '</li>';
			}
		}
		echo '</ul>';
	}

	/**
	 * Sanitizes form inputs on save
	 *
	 * @param array $new_instance , the new value.
	 * @param array $old_instance , the old value.
	 *
	 * @return array $new_instance
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title']             = esc_attr( $new_instance['title'] );
		$instance['title_from_parent'] = (int) $new_instance['title_from_parent'];
		$instance['title_link']        = (int) $new_instance['title_link'];
		$instance['deep_subpages']     = (int) $new_instance['deep_subpages'];
		$instance['nest_subpages']     = (int) $new_instance['nest_subpages'];

		return $instance;
	}

	/**
	 * Build the widget's form
	 *
	 * @param array $instance , An array of settings for this widget instance.
	 */
	public function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title'             => '',
			'title_from_parent' => 0,
			'title_link'        => 0,
			'deep_subpages'     => 0,
			'nest_subpages'     => 0,
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'nightingale-2-0' ); ?></label>
			<input class="widefat" type="text" <?php echo 'id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" value="' . esc_attr( $instance['title'] ) . '"'; ?> />
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_from_parent'], 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'title_from_parent' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_from_parent' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_from_parent' ) ); ?>"><?php	esc_attr_e( 'Use top level page as section title.', 'nightingale-2-0' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['title_link'], 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'title_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_link' ) ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'title_link' ) ); ?>"><?php echo esc_attr_e( 'Make title a link', 'nightingale-2-0' ) . '<br /><em>(' . esc_attr_e( 'only if "use top level page" is checked', 'nightingale-2-0' ) . ')</em></label>'; ?>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['deep_subpages'], 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'deep_subpages' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deep_subpages' ) ); ?>"/>
			<label for=<?php echo esc_attr( $this->get_field_id( 'deep_subpages' ) ) . '>' . esc_attr_e( 'Include the current page\'s subpages', 'nightingale-2-0' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" value="1" <?php checked( $instance['nest_subpages'], 1 ); ?> id="<?php echo esc_attr( $this->get_field_id( 'nest_subpages' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nest_subpages' ) ); ?>"/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'nest_subpages' ) ) . '">' . esc_attr_e( 'Nest sub-page &lt;ul&gt; inside parent &lt;li&gt;', 'nightingale-2-0' ) . '<br /><em>(' . esc_attr_e( "only if &quot;Include the current page's subpages&quot; is checked", 'nightingale-2-0' ) . ')</em></label>'; ?>
		</p>

		<?php
	}
}