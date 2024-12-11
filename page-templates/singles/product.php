<?php 
get_header(); 

// カスタムフィールドの値を取得
$furigana = SCF::get('product_furigana');
$origin = SCF::get('product_origin');
$icon = SCF::get('product_icon');
?>

<main class="contents contents--product-detail">
    <div class="l-inner">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="product-detail">
                <div class="product-detail__header">
                    <?php if ($icon) : ?>
                        <div class="product-detail__icon">
                            <?php echo wp_get_attachment_image($icon, 'full'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="product-detail__title-area">
                        <?php if ($furigana) : ?>
                            <p class="product-detail__furigana"><?php echo esc_html($furigana); ?></p>
                        <?php endif; ?>
                        <h1 class="product-detail__title"><?php the_title(); ?></h1>
                        <?php if ($origin) : ?>
                            <p class="product-detail__origin">産地：<?php echo esc_html($origin); ?></p>
                        <?php endif; ?>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="product-detail__image">
                            <?php the_post_thumbnail('full'); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-detail__content">
                    <?php the_content(); ?>
                </div>

                <div class="product-detail__footer">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'product_category');
                    if ($terms && !is_wp_error($terms)) :
                        foreach ($terms as $term) :
                    ?>
                        <a href="<?php echo get_term_link($term); ?>" class="product-detail__category">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>