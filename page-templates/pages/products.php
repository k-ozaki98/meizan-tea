<?php get_header('', ['pageId' => 'products']); ?>

<main class="contents contents--products">
  <section class="products">
    <div class="l-inner">
      <h2 class="heading-A"><span>TEA</span>茶</h2>

      <p class="products__intro">中国茶から紅茶、日本茶、ハーブ類まで<br class="is-Sp">常時数百種類の茶葉を取り扱っています。</p>

      <?php
        // product_categoryタクソノミーからカテゴリーを取得
        $categories = get_terms(array(
            'taxonomy' => 'product_category',
            'orderby' => 'term_order',
            'hide_empty' => false, // 空のカテゴリーも取得
            'parent' => 0,
        ));

        ?>

      <?php if ($categories) : ?>
      <ul class="products__list">
        <?php foreach ($categories as $category) : ?>
        <?php
            $category_image = get_field('category_image', $category);
            $category_text = get_field('category_text', $category);
            $category_link = get_term_link($category);
        ?>
        <li class="product-item">
          <a class="product-item__img-link" href="<?php echo esc_url($category_link); ?>">
            <div class="product-item__img product-item__img--<?= $category->slug ?>">
              <img src="<?php echo esc_html($category_image); ?>" alt="<?php echo esc_attr($category->name); ?>">
            </div>
          </a>
          <p class="product-item__text"><?php echo nl2br(esc_html($category_text)); ?></p>
          <div class="btn-A"><a href="<?php echo esc_url($category_link); ?>"><span>VIEW MORE</span></a></div>
        </li>
        <?php endforeach; ?>
      </ul>
      <?php else : ?>
      <p>カテゴリーが見つかりませんでした。</p>
      <?php endif; ?>


    </div>
    <div class="l-inner l-inner--sp">
      <section class="product-guide">
        <h3 class="product-guide__heading">取り扱い商品のご案内</h3>
        <div class="product-guide__wrap">
          <p class="product-guide__ttl">お茶全般</p>
          <ul class="product-guide__list">
            <li class="product-guide__item">中国茶</li>
            <li class="product-guide__item">台湾茶</li>
            <li class="product-guide__item">紅茶（インド・セイロン他）</li>
            <li class="product-guide__item">ハーブティー</li>
            <li class="product-guide__item">フレーバーティー</li>
            <li class="product-guide__item">アレンジティー</li>
            <li class="product-guide__item">ヘルスティー</li>
            <li class="product-guide__item">日本茶</li>
            <li class="product-guide__item">業務用ティーバック</li>
            <li class="product-guide__item">ギフトセット</li>
            <li class="product-guide__item">レジサイドパッケージ</li>
            <li class="product-guide__item">その他のパッケージ加工</li>
          </ul>
        </div>
        <!-- <div class="product-guide__wrap">
          <p class="product-guide__ttl">茶器類</p>
          <div class="product-guide__item">各国のバラエティー豊かな茶器類を取り揃えております。</div>
        </div> -->
      </section>

      <section class="product-contact">
        <h3 class="product-contact__ttl">
          まずはお気軽に<br class="is-Sp">お問い合わせください
        </h3>
        <ul class="u-ul-style u-ul-style--disc">
          <li>カフェ、レストラン、ホテル、茶葉専門店などのメニューのご相談をお受けします。</li>
          <li>企業や学校での中国茶・紅茶の研修や講座の企画、出張をいたします。</li>
          <li>お客さまのニーズに合わせてオリジナルブレンドをご用意します。</li>
        </ul>
        <div class="btn-C">
          <a href="/meizan-tea/contact/">お問い合わせはこちら</a>
        </div>
      </section>

    </div>
  </section>
</main>

<?php get_footer(); ?>