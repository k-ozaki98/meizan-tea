<?php

// 通常の分岐
if (is_front_page() || is_home()) {
    get_template_part('page-templates/tops/front');
} elseif (is_tax('product_category')) {
    echo 'This is taxonomy page!';  // この行を追加して、ここに来るか確認
    get_template_part('page-templates/taxonomies/product-category');
} elseif (is_post_type_archive('product')) {
    get_template_part('page-templates/pages/products');
} elseif (is_page()) {
    $page = get_post(get_the_ID());
    $slug = $page->post_name;
    get_template_part('page-templates/pages/' . $slug);
}
?>


