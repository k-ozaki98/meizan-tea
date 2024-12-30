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

    document.addEventListener('wpcf7invalid', function(event) {
      let invalidFields = event.detail.apiResponse.invalid_fields;
      for(let field in invalidFields) {
        let element = document.querySelector(`[name="${field}"]`);
        if(element) {
          element.classList.add('has-error');
        }
      }
    })

    document.querySelectorAll('.wpcf7-form-control').forEach(input => {
      input.addEventListener('input', function() {
        this.classList.remove('has-error');
      });
    })
});
}