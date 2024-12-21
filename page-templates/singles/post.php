<?php
get_header();

$post_id = get_query_var('news_post_id');
$post = get_post($post_id);

if ($post && $post->post_type === 'post') :
    setup_postdata($post);
?>
<main class="contents contents--news-single">
    <div class="container l-inner news">
        <article class="news-article">
            <div class="news-header">
                <div class="news-meta">
                    
                    <?php 
                    $categories = get_the_category($post->ID);
                    if ($categories) : 
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
                    <?php endif; ?>
                    <time class="news-date"><?php echo get_the_date('Y.m.d', $post); ?></time>
                </div>
                <h1 class="news-title"><?php echo esc_html($post->post_title); ?></h1>
            </div>

            <div class="news-content">
                <?php echo apply_filters('the_content', $post->post_content); ?>
            </div>

            <div class="news-footer">
                <div class="btn-B">
                    <a href="<?php echo get_permalink(get_page_by_path('news')); ?>" class="btn-back">
                        新着情報TOPへ
                    </a>
                </div>
            </div>
        </article>
    </div>
</main>
<?php
    wp_reset_postdata();
endif;

get_footer();
?>