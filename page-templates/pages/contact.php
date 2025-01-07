<?php get_header('', ['pageId' => 'contact']); ?>
<main class="contents contents--contact">
    <div class="l-inner contact-inner contact">
        <h2 class="heading-A"><span>CONTACT</span>お問い合わせ</h2>
    
        <div class="contact-img">
            <picture>
                <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri() ?>/assets/images/contact/contact-img-sp.svg">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/contact/contact-img.svg" alt="入力フォーム">
            </picture>
        </div>
        <div class="contact-form">
            <?php
                echo do_shortcode('[contact-form-7 id="7f0ad4c" title="お問い合わせ"]'); 
            ?>
        </div>

    </div>
</main>
<?php get_footer(); ?>

