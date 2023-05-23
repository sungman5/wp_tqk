<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thequeen
 */

?>

<header id="masthead" class="fixed inset-x-0 top-0 z-[999] bg-white border-b border-b-slate-300">
	<!-- Top menu -->
	<div id="top-menu" class="border-b border-b-line">
		<div class="px-4 max-w-[1080px] mx-auto flex justify-between py-3 ">
			<div class="flex gap-2 text-sm font-normal font-overpass">
				<!-- <a href="">Facebook</a> -->
				<a href="https://www.instagram.com/the.queen.korea/" target="_blank">Instagram</a>
				<a href="https://blog.naver.com/yogiyogo" target="_blank">Blog</a>
			</div>
			<!-- <div class="flex gap-4">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'Top-right',
						'menu_id'        => 'Top-right',
						'items_wrap'     => '<ul id="%1$s" class="%2$s font-pretendard font-normal text-sm flex gap-4" aria-label="submenu">%3$s</ul>',
						'container'		 => false,
						'depth'			 => 1,
					)
				);
				?>
				<p class="text-sm">KOR</p>
			</div> -->
			<?php
			if (is_user_logged_in()) {
				// 로그인한 사용자용 메뉴 출력
				wp_nav_menu(array(
					'theme_location' => 'logged', // 로그인한 사용자용 메뉴 위치
					'container' => false,
					'items_wrap'           => '<ul id="%1$s" class="flex gap-4 text-sm font-normal font-pretendard">%3$s</ul>',
				));
			} else {
				// 비로그인 사용자용 메뉴 출력
				wp_nav_menu(array(
					'theme_location'	=> 'not-logged', // 비로그인 사용자용 메뉴 위치
					'container' 	 	=> false,
					'items_wrap'        => '<ul id="%1$s" class="flex gap-4 text-sm font-normal font-pretendard">%3$s</ul>',
				));
			}
			?>
		</div>
	</div>
	<!-- Primary menu -->
	<div id="mouse-enter-area" class="px-4 max-w-[1080px] mx-auto flex items-center justify-between py-2 lg:py-8 lg:h-20 ">
		<!-- left-side -->
		<nav class="gap-8 lg:flex">
			<!-- 사이트 로고 -->
			<div id="site-logo" class="text-2xl font-bold tracking-tighter text-black uppercase lg:flex font-overpass">
				<?php
				if (is_front_page()) :
				?>
					<h1><?php bloginfo('name'); ?></h1>
				<?php
				else :
				?>
					<p><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				$thequeen_description = get_bloginfo('description', 'display');
				if ($thequeen_description || is_customize_preview()) :
				?>
					<p><?php echo $thequeen_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?></p>
				<?php endif; ?>
			</div>
			<!-- Primary menu list -->
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'Primary-menu',
					'menu_id'        => 'Primary-menu',
					'items_wrap'     => '<ul id="%1$s" class="%2$s hidden lg:font-medium font-overpass text-base lg:flex lg:gap-8 lg:items-center" aria-label="submenu">%3$s</ul>',
					'container'		 => false,
					'depth'			 => 1,
				)
			);
			?>
		</nav>
		<!-- right-side -->
		<button id="mobile-nav-btn" aria-controls="primary-menu" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
			</svg>
		</button>
	</div>
	<!-- #site-navigation -->
</header><!-- #masthead -->
<!-- 드롭다운 메뉴 -->
<div id="dropdown-menu" class="fixed inset-x-0 z-[998] justify-center hidden max-h-screen pb-8 overflow-y-scroll shadow-md pt-28 lg:pt-32">
	<?php
	wp_nav_menu(
		array(
			'theme_location' => 'Primary-menu',
			'menu_id'        => 'primary-menu',
			'items_wrap'     => '<ul id="%1$s" class="%2$s px-4 lg:px-6 lg:pt-6 lg:font-medium lg:flex lg:gap-8 lg:w-[1080px] lg:items-start lg:h-fit" aria-label="submenu">%3$s</ul>',
			'container'		 => false,
			'depth'			 => 2,
		)
	);
	?>
</div>