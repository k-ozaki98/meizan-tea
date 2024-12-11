<?php
// function setup_theme_supports() {
//     add_theme_support('title-tag');
//     add_theme_support('post-thumbnails');
//     add_theme_support('html5', [
//         'search-form',
//         'comment-form',
//         'comment-list',
//         'gallery',
//         'caption',
//     ]);

//     // メニューの登録
//     register_nav_menus([
//         'global' => 'グローバルメニュー',
//         'footer' => 'フッターメニュー'
//     ]);
// }
// add_action('after_setup_theme', 'setup_theme_supports');


// /**
//  * カスタムテンプレートディレクトリからテンプレートを読み込む
//  */
// function custom_template_include($template) {
//     // 投稿タイプを取得
//     $post_type = get_post_type();
    
//     if (is_page()) {
//         // ページスラッグを取得
//         $slug = get_post_field('post_name', get_queried_object_id());
        
//         // カスタムテンプレートパスを構築
//         $custom_template = get_template_directory() . 'page-templates/pages/' . $slug . 'php';
        
//         // テンプレートが存在する場合はそれを使用
//         if (file_exists($custom_template)) {
//             return $custom_template;
//         }
//     }
    
//     return $template;
// }
// add_filter('template_include', 'custom_template_include');