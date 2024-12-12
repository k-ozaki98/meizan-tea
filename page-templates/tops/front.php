<?php get_header(); ?>

<main class="contents contents--top">
  <div class="mv">
    <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/mv.png" alt="">
    <div class="mv__wrap">
      <div class="mv__logo">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/common/logo.svg" alt="">
      </div>
      <h2 class="mv__ttl">満たす<br>満ちる</h2>
    </div>
  </div>

  <section class="about">
    <div class="l-inner">
      <h2 class="heading-A"><span>ABOUT US</span>人と心と時間を満たす</h2>
      <p class="about__txt">時に癒やし、時に賑わいの中心となり、人と人、心や時間までもが<br>満ちるお茶のある毎日のために。</p>
      <div class="btn-A">
        <a href="">VIEW MORE</a>
      </div>
      <div class="about__img">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/about-img.png" alt="">
      </div>

      <div class="strength">
        <ul class="strength__card">
          <li>
            <div class="strength__txt-area">
              <p class="strength__num">STRENGTH 01</p>
              <h3 class="strength__ttl">自社輸入</h3>
              <p class="strength__txt">自社輸入だからできる。<br>
                現地農園・工場と連携し、徹底した品質管理の元、<br>
                数百種の茶葉を取り扱っております。
              </p>
              <div class="btn-A btn-A--white">
                <a href="">VIEW MORE</a>
              </div>
            </div>
            <div class="strength__img-area">
              <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/strength-img01.png" alt="">
            </div>
          </li>
          <li>
            <div class="strength__txt-area">
              <p class="strength__num">STRENGTH 02</p>
              <h3 class="strength__ttl">スペシャリスト</h3>
              <p class="strength__txt">明山茶業にはお茶のスペシャリスト、中国政府公認の高級評茶員が在籍しております。
              </p>
              <div class="btn-A btn-A--white">
                <a href="">VIEW MORE</a>
              </div>
            </div>
            <div class="strength__img-area">
              <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/strength-img02.png" alt="">
            </div>
          </li>
          <li>
            <div class="strength__txt-area">
              <p class="strength__num">STRENGTH 03</p>
              <h3 class="strength__ttl">OEM</h3>
              <p class="strength__txt">
                ＜OEM＞様々なご要望に応えるオリジナルティーをご提案します。
              </p>
              <div class="btn-A btn-A--white">
                <a href="">VIEW MORE</a>
              </div>
            </div>
            <div class="strength__img-area">
              <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/strength-img03.png" alt="">
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section class="tea">
    <div class="l-inner">
      <h2 class="heading-A"><span>TEA</span>茶</h2>
      <p class="tea__txt">中国茶から紅茶、日本茶、ハーブ類まで常時数百種類の茶葉を取扱っています。</p>
      <ul class="tea__list">
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img01.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">中国茶</p>
            </div>
          </a>
        </li>
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img02.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">台湾茶</p>
            </div>
          </a>
        </li>
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img03.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">紅　茶</p>
            </div>
          </a>
        </li>
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img04.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">ハーブ類・<br>オリジナル</p>
            </div>
          </a>
        </li>
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img05.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">日本茶</p>
            </div>
          </a>
        </li>
        <li>
          <a href="">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/top/tea-img06.png" alt="">
            <div class="tea__ttl-wrap">
              <p class="tea__ttl">茶外茶</p>
            </div>
          </a>
        </li>
      </ul>
      <div class="btn-A">
        <a href="">VIEW MORE</a>
      </div>
    </div>
  </section>

  <section class="news">
    <div class="news__container">
      <div class="news__ttl-area">
        <h2 class="heading-A"><span>NEWS</span>新着情報</h2>
        <div class="btn-A">
          <a href="/news/">VIEW MORE</a>
        </div>
      </div>
      <ul class="news__list">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish'
            );

            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) :
                while ($news_query->have_posts()) : $news_query->the_post();
                    $categories = get_the_category();
                    $category = $categories ? $categories[0]->name : '';
            ?>
                <li>
                    <div class="news__date-area">
                        <p class="news__cate"><?php echo esc_html($category); ?></p>
                        <p class="news__date"><?php echo get_the_date('Y.m.d'); ?></p>
                    </div>
                    <a href="<?php echo home_url('/news/' . get_the_ID() . '/'); ?>" class="news__ttl">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <li>
                    <p>新着情報はありません。</p>
                </li>
            <?php endif; ?>
        </ul>
    </div>
  </section>
  <div id="js-pagetop" class="pagetop">
    <a href="/">PAGE TOP</a>
  </div>
</main>
<?php get_footer(); ?>