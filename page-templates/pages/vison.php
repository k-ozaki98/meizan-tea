<?php get_header('', ['pageId' => 'about']); ?>

<main class="contents contents--vison">
  <div class="l-inner">
    <h2 class="heading-A"><span>VISON</span>ビジョン</h2>

    <div class="vison-mv">
      <div class="vison-mv__img">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/vison-img.png" alt="">
      </div>
      <p class="vison-mv__txt">満たす<br>満ちる</p>
    </div>
  </div>
  <div class="about-story">
    <ul class="about-story__wrap">
      <li>
        <a class="about-story__bg" href="">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/about-story02.jpg" alt="">
          <div class="about-story__txt-area">
            <p class="about-story__ttl">私たちの強み</p>
            <div class="btn-A btn-A--white">
              <object><a href=""><span>VIEW MORE</span></a></object>
            </div>
          </div>
        </a>
      </li>
      <li>
        <a class="about-story__bg" href="">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/about/about-story03.jpg" alt="">
          <div class="about-story__txt-area">
            <p class="about-story__ttl">社長インタビュー</p>
            <div class="btn-A btn-A--white">
              <object><a href=""><span>VIEW MORE</span></a></object>
            </div>
          </div>
        </a>
      </li>
    </ul>
  </div>

</main>
<?php get_footer(); ?>