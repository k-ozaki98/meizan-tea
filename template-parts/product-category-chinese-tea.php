<?php

global $current_term;
// 子カテゴリーを取得
$child_terms = get_terms([
    'taxonomy' => 'product_category',
    'orderby' => 'term_order', 
    'parent' => $current_term->term_id,
    'hide_empty' => false,
]);

if (!empty($child_terms)) : ?>
    <p class="child-chinese-text">
    中国と台湾で生産されるお茶の種類は1000~2000種類と言われています。<br>
    製造過程の発酵度合いや、お茶を淹れた時の水色によって六分類されます。<br>
    更に、花茶・工芸茶・茶外茶が三分類されます。
    </p>
    <ul class="child-category-list">
        <?php foreach ($child_terms as $child) : 
            $category_tag = get_field('category_tag', $child);
            $category_icon = get_field('category_image', $child);
            $category_recipe = get_field('category_recipe', $child);
            $category_text = get_field('category_text', $child);
            $is_tea = get_field('category_tea', $child);

            // クラス名を動的に変更
            $item_class = 'child-category-list__item';
            if (!$is_tea) {
                $item_class .= ' child-category-list__other';
            }
        ?>
            <li class="<?php echo esc_attr($item_class); ?>">
                <div class="child-category-card">
                    <div class="child-category-list__head">
                        <h1 class="child-category-list__ttl"><?php echo esc_html($child->name); ?></h1>
                        <?php if ($category_icon) : ?>
                            <div class="child-category-card__icon">
                                <img src="<?php echo esc_url($category_icon) ?>" alt="<?php echo esc_attr($child->name); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($category_tag) : ?>
                        <span class="child-category-list__tag"><?php echo esc_html($category_tag); ?></span>
                    <?php endif; ?>
                    <?php if ($category_recipe) : ?>
                        <span class="child-category-list__recipe">製法 : <?php echo esc_html($category_recipe); ?></span>
                    <?php endif; ?>
                    <div class="child-category-list__body">
                        <?php echo esc_html($category_text); ?>
                    </div>
                    
                    <div class="btn-D">
                        <?php if ($child->slug === 'blue-tea') : ?>
                            <?php 
                            // 各地区のカテゴリー画像を取得
                            $anxi = get_term_by('slug', 'anxi-district', 'product_category');
                            $wuyishan = get_term_by('slug', 'wuyishan-district', 'product_category');
                            $fenghuang = get_term_by('slug', 'fenghuangshan-district', 'product_category');

                            $anxi_icon = get_field('category_image', $anxi);
                            $wuyishan_icon = get_field('category_image', $wuyishan);
                            $fenghuang_icon = get_field('category_image', $fenghuang);
                            ?>
                            <!-- 中国茶-青茶の場合は3つの地区ボタンを表示 -->
                            <a href="<?php echo esc_url(get_term_link('anxi-district', 'product_category')); ?>" class="btn blue-tea-btn">
                                <?php if ($anxi_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($anxi_icon); ?>" alt="安渓地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">安渓地区</span>
                            </a>
                            <a href="<?php echo esc_url(get_term_link('wuyishan-district', 'product_category')); ?>" class="btn blue-tea-btn">
                                <?php if ($wuyishan_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($wuyishan_icon); ?>" alt="武夷山地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">武夷山地区</span>
                            </a>
                            <a href="<?php echo esc_url(get_term_link('fenghuangshan-district', 'product_category')); ?>" class="btn blue-tea-btn">
                                <?php if ($fenghuang_icon) : ?>
                                    <span class="btn-icon"><img src="<?php echo esc_url($fenghuang_icon); ?>" alt="鳳凰山地区"></span>
                                <?php endif; ?>
                                <span class="btn-text">鳳凰山地区</span>
                            </a>
                        <?php else : ?>
                            <!-- 通常のリンク -->
                            <a href="<?php echo get_term_link($child); ?>" class="btn">VIEW MORE</a>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>子カテゴリーが見つかりませんでした。</p>
<?php endif; ?>
