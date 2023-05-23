<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package thequeen
 */

get_header();
?>

<section id="primary">
	<main id="main">
		<section class=" max-w-[1080px] mx-auto px-4 mb-8">
			<?php
			/* Start the Loop */
			while (have_posts()) : ?>
				<div class="">
					<?php the_post(); ?>
					<?php get_template_part('template-parts/content/content', 'borad'); ?>
				</div>

			<?php
				if (is_singular('post')) {
					// Previous/next post navigation.
					the_post_navigation(
						array(
							'next_text' =>
							'<div class="flex items-center justify-between gap-2 px-4 py-1 border rounded-full hover:bg-red-50 bg-slate-100 border-slate-300">
								<p class="hidden text-sm md:text-base md:inline-block">%title</p>
								<p class="text-sm font-semibold md:text-base" aria-hidden="true">' . __('다음 글 &rarr;', 'thequeen') . '</p>
								<p class="sr-only">' . __('Next post:', 'thequeen') . '</p> <br/>
                    		</div>',

							'prev_text' =>
							'<div class="flex items-center justify-between gap-2 px-4 py-1 border rounded-full hover:bg-red-50 bg-slate-100 border-slate-300">
								<p class="text-sm font-semibold md:text-base" aria-hidden="true">' . __('&larr; 이전 글', 'thequeen') . '</p> ' .
								'<p class="sr-only">' . __('Previous post:', 'thequeen') . '</p> <br/>' .
								'<p class="hidden text-sm md:text-base md:inline-block">%title</p></div>',
						)
					);
				}
				// If comments are open, or we have at least one comment, load
				// the comment template.
				// if (comments_open() || get_comments_number()) {
				// 	comments_template();
				// }
			// End the loop.
			endwhile;
			?>
		</section>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
