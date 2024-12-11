<?php


// 定数定義
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

// ファイルのインクルード
require_once THEME_DIR . '/inc/custom-post-types.php';
require_once THEME_DIR . '/inc/enqueue-scripts.php';
require_once THEME_DIR . '/inc/theme-support.php';

// ニュース用のリライトルール
function add_news_rewrite_rules() {
    add_rewrite_rule(
        'news/([0-9]+)/?$',
        'index.php?news_post_id=$matches[1]',
        'top'
    );
}
add_action('init', 'add_news_rewrite_rules');

function add_news_query_vars($vars) {
    $vars[] = 'news_post_id';
    return $vars;
}
add_filter('query_vars', 'add_news_query_vars');

function custom_template_include($template) {
    if (get_query_var('news_post_id')) {
        return get_template_directory() . '/page-templates/singles/post.php';
    }
    return $template;
}
add_filter('template_include', 'custom_template_include');


function save_category_meta($term_id) {
    if (isset($_POST['category_image'])) {
        update_term_meta($term_id, 'category_image', $_POST['category_image']);
    }
    if (isset($_POST['category_text'])) {
        update_term_meta($term_id, 'category_text', $_POST['category_text']);
    }
}
add_action('created_product_category', 'save_category_meta');
add_action('edited_product_category', 'save_category_meta');


