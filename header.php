<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
    <div class="header__inner l-inner">
        <h1 class="header__logo">
            <a href="/"><img src="<?php echo get_template_directory_uri() ?>/assets/images/common/logo.svg" alt=""></a>
        </h1>
        <nav>
            <ul class="header__nav">
                <li class="header__nav-item"><a href="/">トップページ</a></li>
                <li class="header__nav-item"><a href="/about/">私たちのこと</a></li>
                <li class="header__nav-item"><a href="/products/">取扱商品</a></li>
                <li class="header__nav-item"><a href="/news/">新着情報</a></li>
                <li class="header__nav-item"><a href="/company/">会社案内</a></li>
                <li class="header__nav-item"><a href="/contact/">お問い合わせ</a></li>
            </ul>
        </nav>

    </div>

    <!-- <div class="header__hmbbtn">
        <div class="hmb-btn js-hmb-btn">
        <div class="hmb-btn__inner">
            <div class="hmb-btn__hmb">
            <span></span><span></span><span></span>
            </div>
        </div>
        </div>
    </div> -->
</header>

<body>
    
