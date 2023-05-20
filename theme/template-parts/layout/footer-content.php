<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thequeen
 */

?>

<footer id="colophon" class="py-6 md:py-16 bg-slate-50">
	<div id="footer-menu-container" class="max-w-[1080px] px-4 lg:px-0 mx-auto">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'Footer-menu',
				'menu_id'        => 'footer-menu',
				'items_wrap'     => '<ul id="%1$s" class="%2$s hidden md:gap-8 md:grid md:grid-cols-4" aria-label="submenu">%3$s</ul>',
				'container'		 => false,
				'depth'			 => 2,
			)
		);
		?>
		<div class="flex justify-between md:pt-8 md:border-t md:border-t-line">
			<div>
				<a class="block mb-6 text-lg font-medium" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
				<div class="flex flex-col gap-2 text-sm">
					<p>주식회사 더퀸코리아 | 대표자: 김은영 | 사업자번호 : 000-00-0000</p>
					<p>통신판매업: 2023-서울노원-0000 | 개인정보보호책임자: 김은영 | 이메일: info@thequeenkorea.com</p>
					<p>주소: 서울시 노원구 인덕대학교</p>
					<p class="uppercase">©thequeenkorea. ALL RIGHT RESERVED</p>
				</div>
			</div>
			<div class="hidden md:flex md:flex-col md:gap-2">
				<a>Facebook</a>
				<a>Instagram</a>
				<a>Blog</a>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->