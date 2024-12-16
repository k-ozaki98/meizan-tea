<?php get_header('', ['pageId' => 'products']); ?>

<main class="contents contents--products">
    <div class="products">
        <div class="l-inner">
            <h2 class="sec-ttl">
                <span class="sec-ttl__en">TEA</span>
                <span class="sec-ttl__ja">茶</span>
            </h2>

            <p class="products__intro">中国茶から紅茶、日本茶、ハーブ類まで常時数百種類の茶葉を取扱っています。</p>
    
            <?php
            // product_categoryタクソノミーからカテゴリーを取得
            $categories = get_terms(array(
                'taxonomy' => 'product_category',
                'orderby' => 'name', // カテゴリ名でソート
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
                            <div class="product-item__img">
                                <img src="<?php echo esc_html($category_image); ?>" alt="">
                            </div>
                            <p class="product-item__text"><?php echo esc_html($category_text); ?></p>
                            <div class="btn-A"><a href="<?php echo esc_url($category_link); ?>">VIEW MORE</a></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>カテゴリーが見つかりませんでした。</p>
            <?php endif; ?>

            
            
        </div>
    </div>
</main>

<?php get_footer(); ?>
