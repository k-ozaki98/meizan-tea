<?php
$chinese_blend = get_term_by('slug', 'chinese-blend', 'product_category');
$black_blend = get_term_by('slug', 'black-blend', 'product_category');
$other_blend = get_term_by('slug', 'other-blend', 'product_category');

// 現在のタームが子カテゴリーの場合、そのスラッグを取得
$current_category = get_queried_object();
$current_slug = $current_category->slug;


?>

<div class="district-buttons district-buttons--original">
    <div class="btn-D <?php echo ($current_slug === 'chinese-blend') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($chinese_blend); ?>" class="btn">
            <span class="btn-text">中国茶ブレンド</span>
        </a>
    </div>
    <div class="btn-D <?php echo ($current_slug === 'black-blend') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($black_blend); ?>" class="btn">
            <span class="btn-text">紅茶ブレンド</span>
        </a>
    </div>
    <div class="btn-D <?php echo ($current_slug === 'other-blend') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($other_blend); ?>" class="btn">
            <span class="btn-text">その他ブレンド</span>
        </a>
    </div>
</div>

<section class="product-contact product-contact--other">
    <h3 class="product-contact__ttl">
        お客さまのニーズに合わせてオリジナルブレンドをご用意します。
    </h3>
    <p class="product-contact__text">喫茶店や茶葉専門店、レストランなどで使われています。製造ロット、ブレンド配合など、詳細についてはお気軽にお問い合わせください。</p>
    <div class="btn-C">
        <a href="/contact">お問い合わせはこちら</a>
    </div>
</section>