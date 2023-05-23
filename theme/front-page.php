<?php get_header(); ?>

<section>
    <?php
    $page_id = 2;
    $page = get_post($page_id);
    // echo '<h2>' . $page->post_title . '</h2>';
    echo '<p>' . apply_filters('the_content', $page->post_content) . '</p>';
    ?>
</section>
<section id="front-course-archive" class="py-8 md:py-16">
    <div id="course-container" class="px-4 lg:w-[1080px] lg:mx-auto">
        <!-- 섹션 타이틀 -->
        <h2 class="flex items-center justify-center mb-12 text-xl font-semibold text-center md:text-2xl font-pretendard">
            <a href="">
                더퀸에서만 제공하는 특급 뷰티 강의
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </h2>

        <div class="grid grid-cols-1 gap-2 mx-auto md:gap-4 md:grid-cols-2 lg:grid-cols-4">
            <?php
            // 쿼리를 생성하고 실행
            $args = array(
                'post_type' => 'course',
                'posts_per_page' => -1
            );
            $the_query = new WP_Query($args);

            // 루프 시작
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <a class="relative" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('', array(
                            'class' => 'h-[344px] object-cover mb-[14px]'
                        )); ?>
                        <h3 class="mb-0.5"><?php the_title() ?></h3>
                        <p class="text-[15px] text-slate-500 mb-1"><?php the_author(); ?></p>

                        <?php
                        // 강의 가격 출력 부분
                        global $woocommerce;
                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'name' => $post->post_name,  // get_the_title()을 post slug로 변경
                            'posts_per_page' => 1
                        );
                        $products = new WP_Query($args);
                        if ($products->have_posts()) {
                            while ($products->have_posts()) {
                                $products->the_post();
                                $product_obj = wc_get_product(get_the_ID());
                                $regular_price = $product_obj->get_regular_price();
                                $sale_price = $product_obj->get_sale_price();

                                if ($sale_price !== '') { // 할인 중인 경우
                                    echo '<p class="font-semibold text-[18px] font-pretendard text-slate-900">' . wc_price($sale_price) . '</p>';
                                    echo '<p class="text-sm line-through font-pretendard text-slate-500">' . wc_price($regular_price) . '</p>';
                                    echo '<p class="absolute top-0 left-0 px-3 py-1 font-bold text-white bg-gradient-to-r from-pink-500 to-red-500">할인중</p>';
                                } elseif ($regular_price > 0) { // 할인 전 가격 표시
                                    // echo wc_price($regular_price);
                                    echo '<p class="font-semibold text-[18px] font-pretendard text-slate-900">' . wc_price($regular_price) . '</p>';
                                } else {
                                    echo '<p class="inline-block px-2 py-0.5 text-sm text-white bg-black">무료</p>'; // 가격이 0인 경우, 무료로 표시합니다.
                                }
                            }
                            wp_reset_postdata();
                        }
                        ?>

                    </a>
            <?php
                endwhile;
            else :
                echo 'No courses found.';
            endif;

            // 리셋. 워드프레스가 나중에 다른 쿼리를 제대로 처리할 수 있도록 데이터를 원래대로 되돌립니다.
            wp_reset_postdata();
            ?>


        </div>

    </div>
</section>
<section id="front-products-archive" class="py-8 md:py-16">
    <div id="products-container" class="px-4 lg:w-[1080px] lg:mx-auto">
        <!-- 섹션 타이틀 -->
        <h2 class="flex items-center justify-center mb-12 text-xl font-semibold text-center md:text-2xl font-pretendard">
            <a href="">
                모든 상품 보기
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </h2>

        <div class="grid grid-cols-1 gap-2 mx-auto md:gap-4 md:grid-cols-2 lg:grid-cols-4">
            <?php
            // 쿼리를 생성하고 실행
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => 'onlineclass',
                        'operator' => 'NOT IN',
                    ),
                ),
            );

            $the_query = new WP_Query($args);
            // 루프 시작
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) : $the_query->the_post();
                    global $product;
                    $product = wc_get_product(get_the_ID()); ?>
                    <a class="relative mb-8 md:mb-auto" href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('', array(
                            'class' => 'h-[344px] object-cover mb-[14px]'
                        )); ?>
                        <h3 class="mb-0.5"><?php the_title() ?></h3>
                        <!-- <p class="text-[15px] text-slate-500"><?php the_author(); ?></p> -->
                        <?php
                        $sale = get_post_meta(get_the_ID(), '_sale_price', true);
                        $regular = get_post_meta(get_the_ID(), '_regular_price', true);
                        $currency_symbol = get_woocommerce_currency_symbol();
                        if ($sale) {
                            echo '<p class="font-semibold text-[18px] font-pretendard text-slate-900">' . number_format($sale) . $currency_symbol . '</p>';
                            echo '<p class="text-sm line-through font-pretendard text-slate-500">' . number_format($regular) . $currency_symbol . '</p>';
                            echo '<p class="absolute top-0 left-0 px-3 py-1 font-bold text-white bg-gradient-to-r from-pink-500 to-red-500">할인중</p>';
                        } elseif ($regular) {
                            echo '<p class="font-semibold text-[18px] font-pretendard text-slate-900">' . number_format($regular) . $currency_symbol . '</p>';
                        }
                        if (!$product->is_in_stock()) {
                            echo '<p class="inline-block px-2 py-0.5 text-[12px] font-semibold text-white bg-gradient-to-r from-slate-800 to-black">품절</p>';
                        }
                        ?>


                    </a>
            <?php
                endwhile;
            else :
                echo 'No products found.';
            endif;
            // 리셋. 워드프레스가 나중에 다른 쿼리를 제대로 처리할 수 있도록 데이터를 원래대로 되돌립니다.
            wp_reset_postdata();
            ?>


        </div>

    </div>
</section>
<section id="front-event-archive" class="py-8 md:py-16">
    <div id="event-container" class="px-4 lg:w-[1080px] lg:mx-auto">
        <!-- 섹션 타이틀 -->
        <h2 class="flex items-center justify-center mb-12 text-xl font-semibold text-center md:text-2xl font-pretendard">
            <a href="">
                [EVENT]오늘은 어떤 일이?
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
            </svg>
        </h2>
        <div>
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => 'event',
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC'
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <!-- // Post content here -->
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('', array(
                            'class' => 'w-full mb-4'
                        )); ?>
                        <?php the_title('<h2 class="text-lg font-medium">', '</h2>'); ?>
                    </a>
                    <!-- // the_content(); -->
            <?php endwhile;
                wp_reset_postdata();
            else :
            // No posts found
            endif;
            ?>

        </div>
        <!-- 이벤트 카테고리 -->
    </div>
</section>
<section id="front-notice-archive" class="py-8 md:py-16 ">
    <div class="max-w-[1080px] flex flex-col gap-8 text-sm lg:mx-auto lg:flex lg:flex-row lg:gap-2">
        <div id="notice-container" class="px-4 lg:flex-1">
            <!-- 섹션 타이틀 -->
            <h2 class="flex items-center justify-center mb-6 text-xl font-semibold text-center lg:mb-12 md:text-2xl font-pretendard">
                <a href="">
                    공지사항
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </h2>
            <div class="border-t border-t-line">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 8,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'notice',
                        ),
                    ),
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <!-- // Post content here -->
                        <div class="flex gap-2 py-2 border-b border-b-line">
                            <p class="w-12 text-center"><?php the_ID(); ?></p>
                            <h2 class="flex-1 truncate">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p><?php
                                //  the_author();
                                ?></p>
                            <p><?php echo get_the_date('Y-m-d'); ?></p>
                        </div>
                        <!-- // the_content(); -->
                <?php endwhile;
                    wp_reset_postdata();
                else :
                // No posts found
                endif;
                ?>
            </div>
        </div>
        <div id="faq-container" class="px-4 lg:flex-1">
            <!-- 섹션 타이틀 -->
            <h2 class="flex items-center justify-center mb-6 text-xl font-semibold text-center lg:mb-12 md:text-2xl font-pretendard">
                <a href="">
                    자주 묻는 질문
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </h2>
            <div class="border-t border-t-line">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 8,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'faq',
                        ),
                    ),
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <!-- // Post content here -->
                        <div class="flex gap-2 py-2 border-b border-b-line">
                            <p class="w-12 text-center"><?php the_ID(); ?></p>
                            <h2 class="flex-1 truncate">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p><?php
                                //  the_author();
                                ?></p>
                            <p><?php echo get_the_date('Y-m-d'); ?></p>
                        </div>
                        <!-- // the_content(); -->
                <?php endwhile;
                    wp_reset_postdata();
                else :
                // No posts found
                endif;
                ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>