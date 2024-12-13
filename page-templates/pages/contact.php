<?php get_header('', ['pageId' => 'contact']); ?>
<main class="contact">
    <div class="l-inner">
        <div class="container">
            <h2>お問い合わせ</h2>
        </div>
    
        <div class="contact-form">
            <?php
                echo do_shortcode('[contact-form-7 id="7f0ad4c" title="お問い合わせ"]'); 
            ?>
        </div>

    </div>
</main>
<?php get_footer(); ?>