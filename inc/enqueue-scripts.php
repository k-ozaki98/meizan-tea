<?php
function enqueue_theme_assets() {
    // google font読み込み
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap',
        [],
        array(),
        null
    );

    // CSSの読み込み
    if (file_exists(get_theme_file_path('/assets/css/style.css'))) {
        wp_enqueue_style(
            'theme-style',
            get_theme_file_uri('/assets/css/style.css'),
            [],
            file_exists(get_theme_file_path('/assets/css/style.css')) ? filemtime(get_theme_file_path('/assets/css/style.css')) : '1.0'
        );
    }

    // JavaScriptの読み込み
    if (file_exists(get_theme_file_path('/assets/js/index.bundle.js'))) {
        wp_enqueue_script(
            'theme-script',
            get_theme_file_uri('/assets/js/index.bundle.js'),
            [],
            file_exists(get_theme_file_path('/assets/js/index.bundle.js')) ? filemtime(get_theme_file_path('/assets/js/index.bundle.js')) : '1.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');

function enqueue_contact_scripts() {
    // スクリプトを登録
    wp_enqueue_script('contact-scripts', get_template_directory_uri() . '/assets/js/index.bundle.js', array('jquery'), '1.0', true);
    
    // JavaScript用の変数を渡す
    wp_localize_script('contact-scripts', 'wpData', array(
        'homeUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_contact_scripts');