<?php
$pageId = esc_attr(isset($pageId) ? $pageId : '');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:ital,wght@0,100..900;1,100..900&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-pageid="<?php echo isset($args['pageId']) ? esc_attr($args['pageId']) : ''; ?>">
  <?php wp_body_open(); ?>
  <div class="wrap">
    <header class="header" id="header">
      <div class="header__inner">
        <h1 class="header__logo">
          <a href="/"><img src="<?php echo get_template_directory_uri() ?>/assets/images/common/logo.svg" alt=""></a>
        </h1>
        <nav>
          <ul class="header__nav is-Pc_Tab">
            <li class="header__nav-item" data-nav-id="top"><a href="/">トップページ</a></li>
            <li class="header__nav-item" data-nav-id="about"><a href="/about/">私たちのこと</a></li>
            <li class="header__nav-item" data-nav-id="products"><a href="/products/">取扱商品</a></li>
            <li class="header__nav-item" data-nav-id="news"><a href="/news/">新着情報</a></li>
            <li class="header__nav-item" data-nav-id="company"><a href="/company/">会社案内</a></li>
            <li class="header__nav-item" data-nav-id="contact"><a href="/contact/">お問い合わせ</a></li>
          </ul>
        </nav>

      </div>

      <div class="header__hmbbtn is-Sp">
        <div class="hmb-btn js-hmb-btn">
          <div class="hmb-btn__inner">
            <div class="hmb-btn__hmb">
              <span></span><span></span><span></span>
            </div>
          </div>
        </div>
      </div>
    </header>
  </div>

  <div class="menu-sp is-Sp">
    <ul class="menu-sp__nav">
      <li class="menu-sp__nav-item"><a href="/">トップページ<span>TOP PAGE</span></a></li>
      <li class="menu-sp__nav-item"><a href="/about/">私たちのこと<span>ABOUT US</span></a></li>
      <li class="menu-sp__nav-item"><a href="/products/">取扱商品<span>TEA</span></a></li>
      <li class="menu-sp__nav-item"><a href="/news/">新着情報<span>NEWS</span></a></li>
      <li class="menu-sp__nav-item"><a href="/company/">会社案内<span>COMPANY</span></a></li>
      <li class="menu-sp__nav-item"><a href="/contact/">お問い合わせ<span>CONTACT</span></a></li>
    </ul>
    <ul class="menu-sp__bnr">
      <li>
        <a href=""><img src="<?php echo get_template_directory_uri() ?>/assets/images/common/footer-bnr01.png" alt=""></a>
      </li>
      <li>
        <a target="_blank" href="https://www.amazon.co.jp/s?rh=n%3A57239051%2Cp_4%3Ameizan+tea&ref=bl_dp_s_web_57239051"><img src="<?php echo get_template_directory_uri() ?>/assets/images/common/footer-bnr02.png" alt=""></a>
      </li>
    </ul>
  </div>
  <div class="fix-btn is-Pc_Tab">
    <a href="">
      <div class="wave"></div>
      <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/footer-btn.svg" alt="">
      <div class="fix-btn__txt">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/footer-btn-txt.svg" alt="">
      </div>
    </a>
  </div>

  <body>