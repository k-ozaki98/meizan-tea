<?php
// yearパラメータがある場合のニュースページの処理
if (is_page('news') || (!empty($_GET['year']) && get_query_var('pagename') === 'news')) {
    get_template_part('page-templates/pages/news');
}
// 通常の分岐
if (is_front_page() || is_home()) {
    get_template_part('page-templates/tops/front');
} elseif (is_tax('product_category')) {
    get_template_part('page-templates/taxonomies/product-category');
} elseif (is_post_type_archive('product')) {
    get_template_part('page-templates/pages/products');
} elseif (is_page()) {
    $page = get_post(get_the_ID());
    $slug = $page->post_name;
    get_template_part('page-templates/pages/' . $slug);
} else {
    // ページが見つからない場合、トップページにリダイレクト
    wp_redirect(home_url());
    exit;
}
?>
?>


