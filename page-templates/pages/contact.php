<?php get_header('', ['pageId' => 'contact']); ?>
<main class="contents contents--contact">
    <div class="l-inner contact-inner contact">
        <h2 class="sec-ttl">
            <span class="sec-ttl__en">CONTACT</span>
            <span class="sec-ttl__ja">お問い合わせ</span>
        </h2>
    
        <div class="contact-form">
            <?php
                echo do_shortcode('[contact-form-7 id="7f0ad4c" title="お問い合わせ"]'); 
            ?>
        </div>

    </div>
</main>
<?php get_footer(); ?>

