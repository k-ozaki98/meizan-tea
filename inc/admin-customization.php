<?php
// 商品管理画面のカスタマイズ
function add_product_category_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'date') {
            $new_columns['product_category'] = 'カテゴリー';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_product_posts_columns', 'add_product_category_column');

function display_product_category_column($column, $post_id) {
    if ($column === 'product_category') {
        $terms = get_the_terms($post_id, 'product_category');
        if (!empty($terms)) {
            $term_names = array();
            foreach ($terms as $term) {
                if ($term->parent) {
                    $parent = get_term($term->parent, 'product_category');
                    $term_names[] = $parent->name . ' > ' . $term->name;
                } else {
                    $term_names[] = $term->name;
                }
            }
            echo implode(', ', $term_names);
        }
    }
}
add_action('manage_product_posts_custom_column', 'display_product_category_column', 10, 2);

function add_product_category_filter() {
    global $typenow;
    if ($typenow === 'product') {
        $selected = isset($_GET['product_category']) ? $_GET['product_category'] : '';
        $dropdown_args = array(
            'taxonomy' => 'product_category',
            'name' => 'product_category',
            'show_option_all' => 'すべてのカテゴリー',
            'hide_empty' => false,
            'hierarchical' => true,
            'selected' => $selected
        );
        wp_dropdown_categories($dropdown_args);
    }
}
add_action('restrict_manage_posts', 'add_product_category_filter');

function modify_product_category_filter_query($query) {
    global $pagenow;
    $qv = &$query->query_vars;
    if ($pagenow === 'edit.php' && 
        isset($qv['product_category']) && 
        is_numeric($qv['product_category']) && 
        $qv['product_category'] != 0
    ) {
        $term = get_term_by('id', $qv['product_category'], 'product_category');
        $qv['product_category'] = $term->slug;
    }
}
add_filter('parse_query', 'modify_product_category_filter_query');