<?php get_header(); ?>

<div class="product-detail-page">
    <?php
    // 商品ページがある場合
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <div class="product-detail">
                <h1><?php the_title(); ?></h1>
                
                <div class="product-image">
                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    }
                    ?>
                </div>

                <div class="product-description">
                    <p><?php the_content(); ?></p>
                </div>

                <div class="product-meta">
                    <p><strong>価格:</strong> ¥<?php echo get_post_meta( get_the_ID(), 'product_price', true ); ?></p>
                    <p><strong>カテゴリー:</strong> <?php the_terms( get_the_ID(), 'product_category' ); ?></p>

                    <!-- カスタムフィールドを表示 -->
                    <p><strong>アイコン画像:</strong> 
                        <?php 
                        $icon = get_post_meta( get_the_ID(), 'icon', true );
                        if ( $icon ) {
                            echo '<img src="' . esc_url( $icon ) . '" alt="アイコン画像">';
                        } 
                        ?>
                    </p>

                    <p><strong>名称:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'name', true ) ); ?></p>
                    <p><strong>フリガナ:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'furigana', true ) ); ?></p>
                    <p><strong>産地:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), 'origin', true ) ); ?></p>
                    <p><strong>詳細:</strong> <?php echo nl2br( esc_html( get_post_meta( get_the_ID(), 'details', true ) ) ); ?></p>
                </div>

                <div class="product-share">
                    <!-- SNS共有ボタンなど -->
                    <p>この商品を共有</p>
                </div>
            </div>
        <?php endwhile;
    else :
        echo '<p>商品が見つかりませんでした。</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
