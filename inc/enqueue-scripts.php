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