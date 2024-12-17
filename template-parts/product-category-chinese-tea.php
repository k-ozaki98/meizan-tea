<?php

global $current_term;
// 子カテゴリーを取得
$child_terms = get_terms([
    'taxonomy' => 'product_category',
    'parent' => $current_term->term_id,
    'hide_empty' => false,
]);

if (!empty($child_terms)) : ?>
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
                <div href="<?php echo get_term_link($child); ?>" class="child-category-card">
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
                        <a href="<?php echo get_term_link($child); ?>">VIEW MORE</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>子カテゴリーが見つかりませんでした。</p>
<?php endif; ?>
