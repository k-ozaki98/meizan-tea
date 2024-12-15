import $ from "jquery";

export const initContact = () => {
  document.addEventListener('wpcf7mailsent', function(event) {
    
    // WordPressのホームURLを取得（wp_localize_scriptで渡す必要があります）
    const homeUrl = window.wpData ? window.wpData.homeUrl : '';
    window.location.href = `${homeUrl}/thanks/`;
});

  $(document).ready(function($) {
    // 住所検索ボタンのクリックイベント
    $('.address-search-btn').on('click', function() {
        var zip1 = $('input[name="your-zip1"]').val();
        var zip2 = $('input[name="your-zip2"]').val();
        
        // AjaxZip3の実行
        AjaxZip3.zip2addr(
            'your-zip1',
            'your-zip2',
            'your-pref',
            'your-address'
        );
    });
});
}