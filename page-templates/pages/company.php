<?php get_header('', ['pageId' => 'company']); ?>

<main class="contents contents--company">
  <div class="l-inner">
    <h2 class="heading-A"><span>COMPANY</span>会社案内</h2>

    <section class="company">
      <h3 class="company__ttl">会社概要</h3>

      <dl class="company__wrap">
        <dt>商号</dt>
        <dd>明山茶業株式会社（ MEIZAN TEA Co., Ltd. ）</dd>
        <dt>設立</dt>
        <dd>1981年（昭和56年）6月</dd>
        <dt>所在地</dt>
        <dd>＜本社・倉庫＞<br>〒160-0022　東京都新宿区新宿1-25-11<br>＜営業オフィス＞<br>〒160-0022　東京都新宿区新宿1-29-16-201（東京メトロ丸の内線 新宿御苑駅 徒歩3分）<br>TEL: 03-3351-3240　FAX: 03-3351-3242　E-mail: info@meizan-tea.co.jp</dd>
      </dl>
    </section>

    <section class="history">
      <h3 class="company__ttl">沿革</h3>

      <dl class="history__wrap">
        <dt><span>1981年</span></dt>
        <dd>6月　明山茶業株式会社　現取締役会長 砂押 雅夫が東京都新宿区富久町にて設立</dd>
        <dt><span>1987年</span></dt>
        <dd>FOODEX JAPAN　国際食品・飲料展（幕張メッセ）に参加以降、現在も継続出展中</dd>
      </dl>
    </section>

    <section class="img-area">
      <div class="img-area__wrap">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/company/company01.jpg" alt="">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/company/company02.jpg" alt="">
        <img src="<?php echo get_template_directory_uri() ?>/assets/images/company/company03.jpg" alt="">
      </div>
    </section>
  </div>
</main>
<?php get_footer(); ?>