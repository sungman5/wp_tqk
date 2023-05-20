<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thequeen
 */

?>

<footer id="colophon" class="bg-slate-50">
	<div>
		<?php
		$thequeen_blog_info = get_bloginfo( 'name' );
		if ( ! empty( $thequeen_blog_info ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php
		endif;

		/* translators: 1: WordPress link, 2: WordPress. */
		// printf(
		// 	'<a href="%1$s">proudly powered by %2$s</a>.',
		// 	esc_url( __( 'https://wordpress.org/', 'thequeen' ) ),
		// 	'WordPress'
		// );
		?>
	</div>

</footer><!-- #colophon -->
