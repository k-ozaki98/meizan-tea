<?php get_header('', ['pageId' => 'about']); ?>

<main class="contents contents--vison">
  <div class="l-inner">
    <h2 class="heading-A"><span>VISION</span>ビジョン</h2>

    <div class="vison-mv">
      <div class="vison-mv__img">
        <picture>
          <source media="(max-width:767px)" type="image/png" srcset="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-img_sp.png" />
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-img.png" alt="">
        </picture>
      </div>
      <p class="vison-mv__txt">満たす<br>満ちる</p>
    </div>

    <section class="vison">
      <h2 class="vison__ttl">人と心と時間を満たす</h2>
      <p class="vison__txt">この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。</p>
      <p class="vison__txt">この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。</p>
      <p class="vison__txt">この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。</p>

      <div class="vison__name-area">
        <p class="vison__name">代表取締役<br>砂押 悠子</p>
        <div class="vison__img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-name.png" alt="" width="140" height="30">
        </div>
      </div>
    </section>
  </div>
  <div class="about-story">
    <ul class="about-story__wrap">
      <li>
        <a class="about-story__bg" href="/meizan-tea/strength/">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/about-story02.jpg" alt="">
          <div class="about-story__txt-area">
            <p class="about-story__ttl">私たちの強み</p>
            <div class="btn-A btn-A--white">
              <object><a href="/strength/"><span>VIEW MORE</span></a></object>
            </div>
          </div>
        </a>
      </li>
      <li>
        <a class="about-story__bg" href="/meizan-tea/interview/">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/about-story03.jpg" alt="">
          <div class="about-story__txt-area">
            <p class="about-story__ttl">社長インタビュー</p>
            <div class="btn-A btn-A--white">
              <object><a href="/interview/"><span>VIEW MORE</span></a></object>
            </div>
          </div>
        </a>
      </li>
    </ul>
  </div>

  <div class="btn-B">
    <a href="/meizan-tea/about/">私たちのことTOPへ</a>
  </div>

</main>
<?php get_footer(); ?>