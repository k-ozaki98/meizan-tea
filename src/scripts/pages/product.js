export const initProduct = () => {
    document.querySelectorAll('.product-list__toggle').forEach(toggle => {
        const wrap = toggle.closest('.product-list__wrap');
        const detail = wrap.querySelector('.product-list__detail');
        const teabagIcon = detail.querySelector('.teabag-icon'); // $teabag_type の存在確認

        const lineHeight = parseFloat(window.getComputedStyle(detail).lineHeight);
        const baseMaxHeight = lineHeight * 3;

        // teabag-icon の高さを計算
        const teabagHeight = teabagIcon ?
            teabagIcon.getBoundingClientRect().height + parseFloat(window.getComputedStyle(teabagIcon).marginTop || 0) :
            0;

        const detailHeight = detail.scrollHeight;

        // 3行までの高さ＋teabag の高さを計算
        const maxHeight = baseMaxHeight + teabagHeight;

        // 特別な条件: 3行までのテキストと $teabag_type がある場合
        if (teabagIcon && detailHeight <= maxHeight) {
            toggle.style.display = 'none'; // トグル非表示
            detail.style.maxHeight = 'none'; // 全内容表示
            detail.style.overflow = 'visible';
        }
        // 通常のトグル制御
        else if (detailHeight > maxHeight) {
            toggle.style.display = 'block'; // トグル表示

            toggle.addEventListener('click', () => {
                wrap.classList.toggle('is-open');
                detail.classList.toggle('is-open'); // CSS クラスで制御
            });
        }
        // トグル不要の場合
        else {
            toggle.style.display = 'none'; // トグル非表示
        }
    });
};