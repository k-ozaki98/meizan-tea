<?php


// 定数定義
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());

// ファイルのインクルード
require_once THEME_DIR . '/inc/custom-post-types.php';
require_once THEME_DIR . '/inc/enqueue-scripts.php';
require_once THEME_DIR . '/inc/admin-customization.php';

function custom_page_rules() {
    global $wp_rewrite;
    $wp_rewrite->page_structure = $wp_rewrite->root . '%pagename%';
}
add_action('init', 'custom_page_rules');

// フラッシュルールを追加
function custom_flush_rules(){
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init', 'custom_flush_rules');

function add_query_vars_filter($vars) {
    $vars[] = 'year';
    $vars[] = 'news_post_id'; // 既存のnews_post_idと一緒に追加
    return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');

// ニュース用のリライトルール
function add_news_rewrite_rules() {
    add_rewrite_rule(
        'news/([0-9]+)/?$',
        'index.php?news_post_id=$matches[1]',
        'top'
    );
    // 年でのフィルタリングにも対応するルール
    add_rewrite_rule(
        'news\?year=([0-9]{4})',
        'index.php?pagename=news&year=$matches[1]',
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


function get_page_id($pageId = '') {
    return $pageId;
}


// AjaxZip3を読み込む
function add_ajaxzip3() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('ajaxzip3', 'https://ajaxzip3.github.io/ajaxzip3.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'add_ajaxzip3');


// Simple Custom Post Order の設定
add_filter('scpo_objects', function($objects) {
    $objects[] = 'product'; // カスタム投稿タイプ名
    return $objects;
});

// クエリの並び順を変更
function modify_product_query($query) {
    if (!is_admin() && $query->is_main_query() && is_tax('product_category')) {
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'modify_product_query');

// 台湾茶、オリジナルブレンドのリダイレクト処理
function custom_category_redirects() {
    if (!is_tax('product_category')) return;

    $current_term = get_queried_object();

    // リダイレクトルール
    $redirect_rules = [
        'taiwan-tea' => 'blue-tea-taiwan',     // 台湾茶 → 青茶
        'original' => 'chinese-blend',         // オリジナルブレンド → 中国茶ブレンド
    ];

    if (isset($redirect_rules[$current_term->slug])) {
        $redirect_term = get_term_by('slug', $redirect_rules[$current_term->slug], 'product_category');
        if ($redirect_term) {
            wp_redirect(get_term_link($redirect_term), 301);
            exit;
        }
    }
}
add_action('template_redirect', 'custom_category_redirects');


// 最新の投稿年を取得する関数
function get_latest_post_year() {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $latest_post = get_posts($args);

    if (!empty($latest_post)) {
        // 最新投稿の年を返す
        return get_the_date('Y', $latest_post[0]->ID);
    } else {
        // 投稿がなければ現在の年を返す
        return date('Y');
    }
}