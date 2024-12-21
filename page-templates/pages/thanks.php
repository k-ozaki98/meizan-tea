<?php get_header('', ['pageId' => 'contact']); ?>
<main class="contents contents--contact">
    <div class="l-inner contact-inner contact">
        <h2 class="sec-ttl">
            <span class="sec-ttl__en">CONTACT</span>
            <span class="sec-ttl__ja">お問い合わせ</span>
        </h2>

        <div class="contact-img">
            <picture>
                <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri() ?>/assets/images/contact/thanks-img-sp.svg">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/contact/thanks-img.svg" alt="入力完了">
            </picture>
        </div>
    
        <section class="contact-form complete">
            <h3 class="complete__ttl">お問い合わせありがとうございました。</h3>
            <p class="complete__text">
            折り返し担当者よりご連絡させていただきます。1週間以上ご連絡がない場合、メールアドレスの間違えや、不着も考えられます。誠にお手数ですがもう一度フォームよりご送信いただくか、以下までお電話をお願いいたします。
            </p>
            <p class="complete__tel">お問い合わせ先：<a href="tel:03-3351-3240">03-3351-3240</a></p>
        </section>

        <div class="back-btn">
            <a href="../">トップページへ</a>
        </div>

    </div>
</main>
<?php get_footer(); ?>

