<?php get_header('', ['pageId' => 'product']); ?>

<?php
// 現在のタクソノミー情報を取得
$current_term = get_queried_object();
$parent_term = null;
$display_term = $current_term;
if ($current_term->parent) {
    $parent_term = get_term($current_term->parent, 'product_category');
    if ($parent_term->parent) {
        $grandparent_term = get_term($parent_term->parent, 'product_category');
        $display_term = $grandparent_term; 
    } else {
        $display_term = $parent_term;  
    }
}
$term_title_en = get_field('category_title_en', $display_term);
$categories = get_terms(array(
    'taxonomy' => 'product_category',
    'orderby' => 'term_order', 
    'hide_empty' => false,
    'parent' => 0,
));
?>

<main class="contents contents--products">
    <div class="products">
        <div class="l-inner l-inner--sp">
            <h2 class="sec-ttl">
                <span class="sec-ttl__en"><?php echo esc_html($term_title_en); ?></span>
                <span class="sec-ttl__ja"><?php echo esc_html($display_term->name); ?></span>
                <?php
                $category_subtitle = get_field('category_subtitle', $current_term);
                if ($category_subtitle) : ?>
                    <span class="sec-ttl__heading"><?php echo nl2br(esc_html($category_subtitle)); ?></span>
                <?php endif; ?>
            </h2>

            <?php
            // 孫カテゴリーの場合にテキストを表示
            if ($current_term->parent && ($parent_term = get_term($current_term->parent, 'product_category')) && $parent_term->parent) :
                $sub_category_text = get_field('category_text', $current_term);
                if ($sub_category_text) :
            ?>
                <p class="products__text"><?php echo nl2br(esc_html($sub_category_text)); ?></p>
            <?php 
                endif;
            endif;
            ?>
            
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
                            $subtitle = get_field('subtitle');
                            ?>
                            <li class="product-list__item">
                                <div class="product-list__top">
                                    <div class="product-list__icon">
                                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($icon); ?>">
                                    </div>
                                    <div class="product-list__name">
                                        <h1 class="product-list__name-ja">
                                            <?php the_title(); ?>
                                            <?php if($subtitle) : ?><span class="product-list__sub"><?php echo esc_html($subtitle); ?></span><?php endif; ?>
                                        </h1>
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

            $term_to_check = $current_term;
            if ($current_term->parent) {
                $parent_term = get_term($current_term->parent, 'product_category');
                if ($parent_term->parent) {
                    // 孫カテゴリーの場合は現在のタームを使用
                    $term_to_check = $current_term;
                } else {
                    // 子カテゴリーの場合は親タームを使用
                    $term_to_check = $parent_term;
                }
            }
            
            // ボトムコンテンツ
            $chinese_tea = get_term_by('slug', 'chinese-tea', 'product_category');

            if ($current_term->parent === $chinese_tea->term_id) {
                // 中国茶の子カテゴリーの場合
                switch($current_term->slug) {
                    case 'green-tea':
                        get_template_part('template-parts/chinese-green-tea');
                        break;
                    case 'black-tea-chinese-tea':
                        get_template_part('template-parts/chinese-black-tea');
                        break;
                    case 'dark-tea':
                        get_template_part('template-parts/chinese-dark-tea');
                        break;
                    case 'other-tea-chinese-tea':
                        get_template_part('template-parts/chinese-other-tea');
                }
            } else {
                switch($term_to_check->slug) {
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
                    case 'fenghuangshan-district':
                        get_template_part('template-parts/fenghuangshan');
                        break;
                }

            }
            
            ?>

        </div>
        <div class="l-inner">
            <?php 
            // 中国茶のIDを取得
            $chinese_tea = get_term_by('slug', 'chinese-tea', 'product_category');

            // 現在のタームが中国茶の子カテゴリー（青茶など）の場合、または孫カテゴリー（地区）の場合
            if (($current_term->parent && $current_term->parent === $chinese_tea->term_id) || 
                ($current_term->parent && ($parent = get_term($current_term->parent, 'product_category')) && 
                $parent->parent === $chinese_tea->term_id)) :
            ?> 
                <?php
                // 現在のタームが青茶または青茶の子カテゴリーの場合
                $blue_tea = get_term_by('slug', 'blue-tea', 'product_category');
                if ($current_term->term_id === $blue_tea->term_id || 
                    ($current_term->parent && $current_term->parent === $blue_tea->term_id)) :
                    // 各地区のタームを取得
                    $anxi = get_term_by('slug', 'anxi-district', 'product_category');
                    $wuyishan = get_term_by('slug', 'wuyishan-district', 'product_category');
                    $fenghuang = get_term_by('slug', 'fenghuangshan-district', 'product_category');

                    $anxi_icon = get_field('category_image', $anxi);
                    $wuyishan_icon = get_field('category_image', $wuyishan);
                    $fenghuang_icon = get_field('category_image', $fenghuang);
                ?>
                    <div class="district-buttons">
                        <div class="btn-D <?php echo ($current_term->slug === 'anxi-district') ? 'is-active' : ''; ?>">
                            <a href="<?php echo get_term_link($anxi); ?>" 
                            class="btn">
                                <?php if ($anxi_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($anxi_icon); ?>" alt="安渓地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">安渓地区</span>
                            </a>
                        </div>
                        <div class="btn-D <?php echo ($current_term->slug === 'wuyishan-district') ? 'is-active' : ''; ?>">
                            <a href="<?php echo get_term_link($wuyishan); ?>" 
                            class="btn">
                                <?php if ($wuyishan_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($wuyishan_icon); ?>" alt="武夷山地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">武夷山地区</span>
                            </a>
                        </div>
                        <div class="btn-D <?php echo ($current_term->slug === 'fenghuangshan-district') ? 'is-active' : ''; ?>">
                            <a href="<?php echo get_term_link($fenghuang); ?>" 
                            class="btn">
                                <?php if ($fenghuang_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($fenghuang_icon); ?>" alt="鳳凰山地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">鳳凰山地区</span>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="btn-B chinese-btn">
                    <a href="<?php echo get_term_link($chinese_tea); ?>">中国茶TOPへ</a>
                </div>

            <?php endif; ?>

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
                        <li class="various-tea__item <?php echo $is_current ? 'is-active ' : ''; ?>various-tea__item--<?php echo esc_attr($category->slug); ?>">
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
