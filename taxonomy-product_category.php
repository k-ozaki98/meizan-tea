<?php get_header(); ?>

<?php
// 現在のタクソノミー情報を取得
$current_term = get_queried_object();
$term_title_en = get_field('category_title_en', $current_term);
?>

<main class="contents contents--products">
    <div class="products">
        <div class="l-inner">
            <h2 class="sec-ttl">
                <span class="sec-ttl__en"><?php echo esc_html($term_title_en); ?></span>
                <span class="sec-ttl__ja"><?php single_term_title(); ?></span>
            </h2>
            
            <?php
            $current_term = get_queried_object();
            global $current_term;
            // 中国茶の場合、専用テンプレートを読み込む
            if ($current_term->slug === 'chinese-tea') {
                get_template_part('template-parts/product-category-chinese-tea'); // 別ファイルを読み込む
            } else {
                // 他のカテゴリ用処理
                if (have_posts()) : ?>
                    <ul class="product-list">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                            $icon = get_field('icon');
                            $furigana = get_field('furigana');
                            $origin = get_field('origin');
                            ?>
                            <li class="product-list__item">
                                <div class="product-list__top">
                                    <div class="product-list__icon">
                                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($icon); ?>">
                                    </div>
                                    <div class="product-list__name">
                                        <h1 class="product-list__name-ja"><?php the_title(); ?></h1>
                                        <p class="product-list__name-en"><?php echo esc_html($furigana); ?></p>
                                    </div>
                                </div>
                                <?php if ($origin) : ?>
                                    <p class="product-list__origin">産地: <?php echo esc_html($origin); ?></p>
                                <?php endif; ?>
                                <p class="product-list__detail">
                                    <?php the_content(); ?>
                                </p>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else : ?>
                    <p>商品が見つかりませんでした。</p>
                <?php endif; 
            } ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
