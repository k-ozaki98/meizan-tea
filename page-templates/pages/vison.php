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
      <p class="vison__txt">昨今の社会情勢は変化が激しく、<br class="is-Pc_Tab">ライフスタイルや価値観も多様化しています。<br>そんな変化の中でも私たちが変わらず大切にしていることは、<br class="is-Pc_Tab">人であり、お茶を通して生まれる見えない価値です。</p>
      <p class="vison__txt">心を込めて淹れた一杯のお茶は、<br class="is-Pc_Tab">時に癒やしとなり、時に賑わいに寄り添い、<br>「楽しい」「うれしい」だけでなく、<br class="is-Pc_Tab">生活のあらゆるシーンでそっと支える力となります。</p>
      <p class="vison__txt">私たちは、飲食、飲料、製菓業界に留まらず<br class="is-Pc_Tab">他業界、他分野にも挑戦し、支えとなるプロダクトを作ります。<br class="is-Pc_Tab">そして、どんな時代にあっても<br class="is-Pc_Tab">お茶を通して豊かな毎日を提供する、<br class="is-Pc_Tab">人と心と時間を満たす企業を目指します。</p>
      <p class="vison__txt">まずは、お茶を一杯、どうぞ。</p>

      <div class="vison__name-wrap">
        <div class="vison__name-img">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-icon.png" alt="" width="140" height="30">
        </div>
        <div class="vison__name-area">
          <p class="vison__name">代表取締役</p>
          <div class="vison__img">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-name.png" alt="" width="129" height="36">
          </div>
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