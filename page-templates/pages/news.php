<?php get_header(); ?>
<main class="contents contents--news">
    <div class="container l-inner news">
        <h2 class="sec-ttl">
            <span class="sec-ttl__en">NEWS</span>
            <span class="sec-ttl__ja">新着情報</span>
        </h2>

        <?php
        // 投稿がある年を取得
        global $wpdb;
        $years = $wpdb->get_col(
            "SELECT DISTINCT YEAR(post_date) 
            FROM $wpdb->posts 
            WHERE post_type = 'post' 
            AND post_status = 'publish' 
            ORDER BY post_date DESC"
        );

        // var_dump($years);
        ?>

        <form method="get" class="news-filter-form">
            <label for="filter-year">公開年で絞り込み:</label>
            <select id="filter-year" name="year" onchange="this.form.submit();">
                <option value="">すべての年</option>
                <?php 
                $selected_year = isset($_GET['year']) ? (int)$_GET['year'] : '';
                foreach ($years as $year) : 
                ?>
                    <option value="<?php echo esc_attr($year); ?>" 
                            <?php selected($selected_year, (int)$year); ?>>
                        <?php echo esc_html($year); ?>年
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_status' => 'publish'
        );

        if (!empty($_GET['year'])) {
            $args['date_query'] = array(
                array(
                    'year' => intval($_GET['year'])
                )
            );
        }
        
        $news_query = new WP_Query($args);

        if ($news_query->have_posts()) : ?>
            <ul class="news-list">
                <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                <li class="news-list__item">
                    <a href="<?php echo home_url('/news/' . get_the_ID() . '/'); ?>">
                        <div class="news-list__top">
                        <?php 
                        $categories = get_the_category();
                        if ($categories) {
                            $category = $categories[0];
                            $category_class = '';
                            switch($category->name) {
                                case 'お知らせ':
                                    $category_class = 'news-category--news';
                                    break;
                                case 'イベント':
                                    $category_class = 'news-category--event';
                                    break;
                                default:
                                    $category_class = 'news-category--default';
                            }
                        ?>
                            <span class="news-category <?php echo esc_attr($category_class); ?>">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php } ?>
                            <span class="date">
                                <?php echo get_the_date('Y.m.d'); ?>
                            </span>
                        </div>
                        <h1 class="news-list__ttl"><?php the_title(); ?></h1>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>

            <?php
            // ページネーション
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $news_query->max_num_pages,
                'prev_text' => '前へ',
                'next_text' => '次へ',
                'add_args' => !empty($_GET['year']) ? array('year' => $_GET['year']) : array()
            ));
            ?>

        <?php else : ?>
            <p class="no-posts">お知らせはありません。</p>
        <?php 
        endif;
        wp_reset_postdata();
        ?>
    </div>
</main>
<?php get_footer(); ?>