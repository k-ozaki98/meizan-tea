export const initProduct = () => {
    document.querySelectorAll('.product-list__toggle').forEach(toggle => {
        const wrap = toggle.closest('.product-list__wrap');
        const detail = wrap.querySelector('.product-list__detail');

        // `1.8em` と `4.5rem` をピクセル単位で計算
        const computedStyle = window.getComputedStyle(detail);
        const lineHeight = parseFloat(computedStyle.lineHeight); // `1.8em` の計算
        const remToPx = parseFloat(getComputedStyle(document.documentElement).fontSize); // `1rem` のピクセル値取得
        const maxHeight = (lineHeight * 3) + (4.5 * remToPx); // `calc((1.8em * 3) + 4.5rem)` を計算

        // ディテールの高さが指定の高さ以下の場合、トグルを非表示
        if (detail.scrollHeight <= maxHeight) {
            toggle.style.display = 'none';
        } else {
            toggle.style.display = 'block';

            toggle.addEventListener('click', () => {
                wrap.classList.toggle('is-open');
            });
        }
    });
};