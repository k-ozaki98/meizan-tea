<?php get_header('', ['pageId' => 'contact']); ?>
<main class="contact">
    <div class="container">
        <h2>お問い合わせ</h2>
    </div>

    <div class="contact-form">
        <?php
            echo do_shortcode('[contact-form-7 id="2fe2071" title="お問い合わせ"]'); 
        ?>
    </div>
</main>
<?php get_footer(); ?>