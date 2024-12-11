<?php

// 商品のカスタム投稿タイプを登録
function register_product_post_type() {
    $args = array(
        'labels' => array(
            'name' => '商品',
            'singular_name' => '商品',
            'add_new' => '新規追加',
            'add_new_item' => '新しい商品を追加',
            'edit_item' => '商品を編集',
            'new_item' => '新しい商品',
            'view_item' => '商品を見る',
            'all_items' => 'すべての商品',
            'search_items' => '商品を検索',
            'not_found' => '商品は見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱に商品はありません',
            'menu_name' => '商品'
        ),
        'public' => true, // 公開状態
        'has_archive' => true, // アーカイブページを有効化
        'show_in_rest' => true, // ブロックエディタ対応
        'supports' => array( 'title', 'editor', 'thumbnail' ), // サポートするフィールド
        'taxonomies' => array('product_category'), // タクソノミーとの関連付け
        'rewrite' => array('slug' => 'product'), // パーマリンクの設定
    );
    register_post_type( 'product', $args );
}
add_action( 'init', 'register_product_post_type' );

// 商品カテゴリーのタクソノミーを登録
function register_product_category_taxonomy() {
    $args = array(
        'hierarchical' => true, // カテゴリ型（階層構造）
        'labels' => array(
            'name' => '商品カテゴリー',
            'singular_name' => '商品カテゴリー',
            'search_items' => 'カテゴリーを検索',
            'all_items' => 'すべてのカテゴリー',
            'parent_item' => '親カテゴリー',
            'parent_item_colon' => '親カテゴリー:',
            'edit_item' => 'カテゴリーを編集',
            'update_item' => 'カテゴリーを更新',
            'add_new_item' => '新しいカテゴリーを追加',
            'new_item_name' => '新しいカテゴリー名',
            'menu_name' => '商品カテゴリー',
        ),
        'show_ui' => true,
        'show_in_rest' => true, // ブロックエディタ対応
        'rewrite' => array( 'slug' => 'product-category' ), // パーマリンク設定
        'object_type' => array('product'), // 投稿タイプを指定
    );
    register_taxonomy( 'product_category', 'product', $args );
}
add_action( 'init', 'register_product_category_taxonomy' );


// 中国茶カテゴリーの時のみ子カテゴリーを表示する関数
// function get_chinese_tea_subcategories() {
//     // 現在のタームを取得
//     $current_term = get_queried_object();
    
//     // 中国茶のタームIDを取得（スラッグで検索）
//     $china_tea = get_term_by('slug', 'chinese-tea', 'product_category');
    
//     // 中国茶カテゴリーの場合のみ子カテゴリーを取得
//     if ($china_tea && $current_term->term_id === $china_tea->term_id) {
//         return get_terms([
//             'taxonomy' => 'product_category',
//             'parent' => $current_term->term_id,
//             'hide_empty' => false
//         ]);
//     }
    
//     return false;
// }

// // カテゴリー用のACFフィールドを追加
// function add_category_custom_fields() {
//     if (function_exists('acf_add_local_field_group')) {
//         acf_add_local_field_group([
//             'key' => 'group_tea_category',
//             'title' => 'カテゴリー詳細設定',
//             'fields' => [
//                 [
//                     'key' => 'field_category_image',
//                     'label' => 'カテゴリー画像',
//                     'name' => 'category_image',
//                     'type' => 'image',
//                     'return_format' => 'url',
//                 ],
//                 [
//                     'key' => 'field_category_description',
//                     'label' => '詳細説明',
//                     'name' => 'category_description',
//                     'type' => 'textarea',
//                 ]
//             ],
//             'location' => [
//                 [
//                     [
//                         'param' => 'taxonomy',
//                         'operator' => '==',
//                         'value' => 'product_category',
//                     ],
//                 ],
//             ],
//         ]);
//     }
// }
// add_action('acf/init', 'add_category_custom_fields');