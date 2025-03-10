<?php get_header('', ['pageId' => 'product']); ?>

<?php
// 現在のタクソノミー情報を取得
$current_term = get_queried_object();
$parent_term = null;
$display_term = $current_term;
if ($current_term->parent) {
    $parent_term = get_term($current_term->parent, 'product_category');
    if ($parent_term->parent) {
        $grandparent_term = get_term($parent_term->parent, 'product_category');
        $display_term = $grandparent_term;
    } else {
        $display_term = $parent_term;
    }
}
$term_title_en = get_field('category_title_en', $display_term);
$categories = get_terms(array(
    'taxonomy' => 'product_category',
    'orderby' => 'term_order',
    'hide_empty' => false,
    'parent' => 0,
));
?>

<main class="contents contents--products <?php echo ('contents--' . $current_term->slug); ?>">
  <div class="products">
    <div class="l-inner l-inner--sp">
      <h2 class="sec-ttl">
        <span class="sec-ttl__en"><?php echo esc_html($term_title_en); ?></span>
        <span class="sec-ttl__ja"><?php echo esc_html($display_term->name); ?></span>
        <?php
                $category_subtitle = get_field('category_subtitle', $current_term);
                if ($category_subtitle) : ?>
        <span class="sec-ttl__heading"><?php echo nl2br(esc_html($category_subtitle)); ?></span>
        <?php endif; ?>
      </h2>

      <?php
            // 孫カテゴリーの場合にテキストを表示
            if ($current_term->parent && ($parent_term = get_term($current_term->parent, 'product_category')) && $parent_term->parent) :
                $sub_category_text = get_field('category_text', $current_term);
                if ($sub_category_text) :
            ?>
      <p class="products__text"><?php echo nl2br(esc_html($sub_category_text)); ?></p>
      <?php
                endif;
            endif;
            ?>

      <?php
            $current_term = get_queried_object();
            global $current_term;

            $template_mapping = [
                'taiwan-tea' => 'product-category-taiwan',
                'blue-tea-taiwan' => 'product-category-taiwan',
                'black-tea-taiwan' => 'product-category-taiwan',
                'jasmine-tea-taiwan' => 'product-category-taiwan',
                'chinese-blend' => 'original-top',
                'black-blend' => 'original-top',
                'other-blend' => 'original-top'
            ];

            if (isset($template_mapping[$current_term->slug])) {
                get_template_part('template-parts/' . $template_mapping[$current_term->slug]);
            }

            // メインコンテンツ
            if ($current_term->slug === 'chinese-tea') {
                get_template_part('template-parts/product-category-chinese-tea');
            } else {
                if (have_posts()) : ?>
      <ul class="product-list">
        <?php
  $counter = 0; // ループの前でカウンターを初期化
  while (have_posts()) : the_post();
    $counter++; // ループ内でカウンターを増加
    $icon = get_field('icon');
    $furigana = get_field('furigana');
    $origin = get_field('origin');
    $other = get_field('other');
    $subtitle = get_field('subtitle');
    $modal_id = "modal-" . $counter; // 一意なIDを生成
  ?>
        <li class="product-list__item">
          <div class="product-list__top">
            <?php
        $icon = get_field('icon');
        $modal = get_field('modal-icon');
        if ($icon) :
        ?>
            <div class="product-list__icon js-modal" data-modal="<?php echo $modal_id; ?>">
              <?php if (is_array($icon)): ?>
              <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
              <?php else: ?>
              <?php
              $image_id = attachment_url_to_postid($icon);
              $alt_text = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
              ?>
              <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($alt_text); ?>">
              <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class="product-list__name">
              <h1 class="product-list__name-ja">
                <?php the_title(); ?>
                <?php if ($subtitle) : ?>
                <span class="product-list__sub"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
              </h1>
              <p class="product-list__name-en"><?php echo esc_html($furigana); ?></p>
            </div>
          </div>
          <?php if ($origin) : ?>
          <p class="product-list__origin">産地: <?php echo esc_html($origin); ?></p>
          <?php endif; ?>
          <?php if ($other) : ?>
          <p class="product-list__origin"><?php echo esc_html($other); ?></p>
          <?php endif; ?>
          <div class="product-list__wrap">
            <div class="product-list__detail">
              <?php the_content(); ?>
              <?php
          // ティーバッグタイプの取得を追加
          $teabag_type = get_field('teabag_type');
          if ($teabag_type && $teabag_type !== 'none') :
            $type_text = '';
            $type_class = '';
            switch ($teabag_type) {
              case 'triangle':
                $type_text = 'ティーバッグあり';
                $type_class = 'teabag-icon--triangle';
                break;
              case 'normal':
                $type_text = '個包装';
                $type_class = 'teabag-icon--normal';
                break;
            }
          ?>
              <div class="teabag-icon <?php echo $type_class; ?>">
                <span class="icon"></span>
                <span class="text"><?php echo $type_text; ?></span>
              </div>
              <?php endif; ?>
            </div>
            <div class="product-list__toggle is-sp">
              <span class="chevron"></span>
            </div>
          </div>
        </li>

        <?php if ($modal) : ?>
        <div id="<?php echo $modal_id; ?>" class="modal">
          <div class="modal-content">
            <?php if (is_array($modal)): ?>
            <img src="<?php echo esc_url($modal['url']); ?>" alt="<?php echo esc_attr($modal['alt']); ?>">
            <?php else: ?>
            <?php
            $image_id = attachment_url_to_postid($modal);
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            ?>
            <img src="<?php echo esc_url($modal); ?>" alt="<?php echo esc_attr($alt_text); ?>">
            <?php endif; ?>
            <div class="modal-close"><span>×</span>CLOSE</div>
          </div>
        </div>
        <?php endif; ?>

        <?php endwhile; ?>
      </ul>
      <?php else : ?>
      <p>商品が見つかりませんでした。</p>
      <?php endif;
            }

            $term_to_check = $current_term;
            if ($current_term->parent) {
                $parent_term = get_term($current_term->parent, 'product_category');
                if ($parent_term->parent) {
                    // 孫カテゴリーの場合は現在のタームを使用
                    $term_to_check = $current_term;
                } else {
                    // 子カテゴリーの場合は親タームを使用
                    $term_to_check = $parent_term;
                }
            }

            // ボトムコンテンツ
            $chinese_tea = get_term_by('slug', 'chinese-tea', 'product_category');

            if ($current_term->parent === $chinese_tea->term_id) {
                // 中国茶の子カテゴリーの場合
                switch($current_term->slug) {
                    case 'green-tea':
                        get_template_part('template-parts/chinese-green-tea');
                        break;
                    case 'black-tea-chinese-tea':
                        get_template_part('template-parts/chinese-black-tea');
                        break;
                    case 'dark-tea':
                        get_template_part('template-parts/chinese-dark-tea');
                        break;
                    case 'other-tea-chinese-tea':
                        get_template_part('template-parts/chinese-other-tea');
                }
            } else {
                switch($term_to_check->slug) {
                    case 'black-tea':
                        get_template_part('template-parts/black-tea');
                        break;
                    case 'japanese-tea':
                        get_template_part('template-parts/japanese-tea');
                        break;
                    case 'other-tea':
                        get_template_part('template-parts/other-tea');
                        break;
                    case 'original':
                        get_template_part('template-parts/original-bottom');
                        break;
                    case 'fenghuangshan-district':
                        get_template_part('template-parts/fenghuangshan');
                        break;
                }

            }

            ?>

    </div>
    <div class="l-inner">
      <?php
            // 中国茶のIDを取得
            $chinese_tea = get_term_by('slug', 'chinese-tea', 'product_category');

            // 現在のタームが中国茶の子カテゴリー（青茶など）の場合、または孫カテゴリー（地区）の場合
            if (($current_term->parent && $current_term->parent === $chinese_tea->term_id) ||
                ($current_term->parent && ($parent = get_term($current_term->parent, 'product_category')) &&
                $parent->parent === $chinese_tea->term_id)) :
            ?>
      <?php
                // 現在のタームが青茶または青茶の子カテゴリーの場合
                $blue_tea = get_term_by('slug', 'blue-tea', 'product_category');
                if ($current_term->term_id === $blue_tea->term_id ||
                    ($current_term->parent && $current_term->parent === $blue_tea->term_id)) :
                    // 各地区のタームを取得
                    $anxi = get_term_by('slug', 'anxi-district', 'product_category');
                    $wuyishan = get_term_by('slug', 'wuyishan-district', 'product_category');
                    $fenghuang = get_term_by('slug', 'fenghuangshan-district', 'product_category');

                    $anxi_icon = get_field('category_image', $anxi);
                    $wuyishan_icon = get_field('category_image', $wuyishan);
                    $fenghuang_icon = get_field('category_image', $fenghuang);
                ?>
      <div class="district-buttons">
        <div class="btn-D <?php echo ($current_term->slug === 'anxi-district') ? 'is-active' : ''; ?>">
          <a href="<?php echo get_term_link($anxi); ?>" class="btn">
            <?php if ($anxi_icon) : ?>
            <span class="btn-icon"><img src="<?php echo esc_url($anxi_icon); ?>" alt="安渓地区"></span>
            <?php endif; ?>
            <span class="btn-text">安渓地区</span>
          </a>
        </div>
        <div class="btn-D <?php echo ($current_term->slug === 'wuyishan-district') ? 'is-active' : ''; ?>">
          <a href="<?php echo get_term_link($wuyishan); ?>" class="btn">
            <?php if ($wuyishan_icon) : ?>
            <span class="btn-icon"><img src="<?php echo esc_url($wuyishan_icon); ?>" alt="武夷山地区"></span>
            <?php endif; ?>
            <span class="btn-text">武夷山地区</span>
          </a>
        </div>
        <div class="btn-D <?php echo ($current_term->slug === 'fenghuangshan-district') ? 'is-active' : ''; ?>">
          <a href="<?php echo get_term_link($fenghuang); ?>" class="btn">
            <?php if ($fenghuang_icon) : ?>
            <span class="btn-icon"><img src="<?php echo esc_url($fenghuang_icon); ?>" alt="鳳凰山地区"></span>
            <?php endif; ?>
            <span class="btn-text">鳳凰山地区</span>
          </a>
        </div>
      </div>
      <?php endif; ?>
      <div class="btn-B chinese-btn">
        <a href="<?php echo get_term_link($chinese_tea); ?>">中国茶TOPへ</a>
      </div>

      <?php endif; ?>

      <section class="various-tea">
        <h3 class="various-tea__ttl">その他のおすすめ茶種</h3>

        <?php if ($categories) : ?>
        <ul class="various-tea__list">
          <?php foreach ($categories as $category) :
                            $category_icon = get_field('category_icon', $category);
                            $category_link = get_term_link($category);
                            $is_current = ($category->term_id === $current_term->term_id) ||
                            ($current_term->parent && $category->term_id === $current_term->parent) ||
                            ($current_term->parent && ($parent_term = get_term($current_term->parent, 'product_category')) &&
                            $parent_term->parent && $category->term_id === $parent_term->parent);
                        ?>
          <li class="various-tea__item <?php echo $is_current ? 'is-active ' : ''; ?>various-tea__item--<?php echo esc_attr($category->slug); ?>">
            <a href="<?php echo esc_url($category_link); ?>">
              <img src="<?php echo esc_url($category_icon); ?>" alt="<?php echo esc_attr($category->name); ?>">
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
      </section>

    </div>
  </div>
</main>

<?php get_footer(); ?>