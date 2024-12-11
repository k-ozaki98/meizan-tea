<?php
get_header();

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();
        // カスタムテンプレートの読み込み
        include locate_template('page-templates/singles/post.php');
    endwhile;
endif;

get_footer();
