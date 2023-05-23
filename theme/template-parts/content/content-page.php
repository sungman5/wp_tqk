<?php

/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thequeen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php
	$current_url = $_SERVER['REQUEST_URI'];
	$special_pages = array('/cart/', '/my-account/', '/my-courses/'); // 여러 개의 URL을 배열로 정의
	$hide_main = '';

	foreach ($special_pages as $page) {
		if (strpos($current_url, $page) !== false) {
			$hide_main = ' style="display:none;"';
			break;
		}
	}
	?>
	
	<header class="entry-header">
		<?php
		if (!is_front_page()) {
			the_title("<h1 class='entry-title' {$hide_main}>", '</h1>');
		} else {
			the_title('<h2 class="entry-title">', '</h2>');
		}
		?>
	</header><!-- .entry-header -->

	<?php thequeen_post_thumbnail(); ?>

	<div <?php thequeen_content_class('entry-content'); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __('Pages:', 'thequeen'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link()) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						__('Edit <span class="sr-only">%s</span>', 'thequeen'),
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
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->