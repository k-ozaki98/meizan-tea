<?php
$blue_tea = get_term_by('slug', 'blue-tea-taiwan', 'product_category');
$black_tea = get_term_by('slug', 'black-tea-taiwan', 'product_category');
$jasmine_tea = get_term_by('slug', 'jasmine-tea-taiwan', 'product_category');

// 現在のタームが子カテゴリーの場合、そのスラッグを取得
$current_category = get_queried_object();
$current_slug = $current_category->slug;


?>

<div class="district-buttons district-buttons--original l-inner">
    <div class="btn-D <?php echo ($current_slug === 'blue-tea-taiwan') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($blue_tea); ?>" class="btn">
            <span class="btn-text">青茶</span>
        </a>
    </div>
    <div class="btn-D <?php echo ($current_slug === 'black-tea-taiwan') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($black_tea); ?>" class="btn">
            <span class="btn-text">紅茶</span>
        </a>
    </div>
    <div class="btn-D <?php echo ($current_slug === 'jasmine-tea-taiwan') ? 'is-active' : ''; ?>">
        <a href="<?php echo get_term_link($jasmine_tea); ?>" class="btn">
            <span class="btn-text">茉莉花茶</span>
        </a>
    </div>
</div>