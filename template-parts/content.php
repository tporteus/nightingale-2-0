<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="nhsuk-heading-xl">', '</h1>' );
		else :
			the_title( '<h2 class="nhsuk-heading-l"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="nhsuk-review-date">
				<?php
				nightingale_posted_by();
				nightingale_posted_on();
				$readmorelink  = esc_url( get_permalink() );
				$readmoretitle = esc_html( get_the_title() );
				if ( strlen( $readmoretitle ) < 1 ) {
					$readmoretitle = esc_html__( 'this post', 'nightingale' );
					echo '<div class="nhsuk-readmore">' . nightingale_read_more_posts( $readmoretitle, $readmorelink ) . '</div>';
				}
				?>
				</p>
			</div><!-- .article-meta -->
		<?php endif; ?>
	</header><!-- .article-header -->

	<?php nightingale_post_thumbnail(); ?>

	<article>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nightingale' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);


		?>
	</article><!-- .article-content -->
	<div class="nhsuk-content__clearfix"></div>

	<footer class="article-footer">

		<?php nightingale_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
