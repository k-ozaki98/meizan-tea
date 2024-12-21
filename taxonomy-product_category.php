<?php get_header('', ['pageId' => 'product']); ?>

<?php
// 現在のタクソノミー情報を取得
$current_term = get_queried_object();
$term_title_en = get_field('category_title_en', $current_term);
$categories = get_terms(array(
    'taxonomy' => 'product_category',
    'orderby' => 'term_order', 
    'hide_empty' => false,
    'parent' => 0,
));
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

            // トップコンテンツ
            switch($current_term->slug) {
                case 'original':
                    get_template_part('template-parts/original-top');
                    break;
            }

            // メインコンテンツ
            if ($current_term->slug === 'chinese-tea') {
                get_template_part('template-parts/product-category-chinese-tea');
            } else {
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
            }
            
            // ボトムコンテンツ
            switch($current_term->slug) {
                case 'black-tea':
                    get_template_part('template-parts/black-tea');
                    break;
                case 'japanese-tea':
                    get_template_part('template-parts/japanese-tea');
                    break;
                case 'other-tea':
                    get_template_part('template-parts/other-tea');
                    break;
                case 'original':
                    get_template_part('template-parts/original-bottom');
                    break;
            }
            
            ?>

            <section class="various-tea">
                <h3 class="various-tea__ttl">その他のおすすめ茶種</h3>

                <?php if ($categories) : ?>
                    <ul class="various-tea__list">
                        <?php foreach ($categories as $category) :
                            $category_icon = get_field('category_icon', $category);
                            $category_link = get_term_link($category);
                            $is_current = ($category->term_id === $current_term->term_id) || 
                            ($current_term->parent && $category->term_id === $current_term->parent) ||
                            ($current_term->parent && ($parent_term = get_term($current_term->parent, 'product_category')) && 
                            $parent_term->parent && $category->term_id === $parent_term->parent);
                        ?>
                        <li class="various-tea__item <?php echo $is_current ? 'is-active' : ''; ?>">
                            <a href="<?php echo esc_url($category_link); ?>">
                                <img src="<?php echo esc_url($category_icon); ?>" alt="<?php echo esc_attr($category->name); ?>">
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>

<?php get_footer(); ?>
