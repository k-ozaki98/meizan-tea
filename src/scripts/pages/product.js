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

    const modalBtns = document.querySelectorAll(".js-modal");
    modalBtns.forEach(function (btn) {
        btn.onclick = function () {
            const modalId = btn.getAttribute("data-modal"); // 対応するモーダルのIDを取得
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = "block";
                document.body.style.overflow = "hidden";
            }
        };
    });

    const closeBtns = document.querySelectorAll(".modal-close");
    closeBtns.forEach(function (btn) {
        btn.onclick = function () {
            const modal = btn.closest(".modal"); // 親のモーダルを取得
            if (modal) {
                modal.style.display = "none";
                document.body.style.overflow = "auto";
            }
        };
    });

    window.onclick = function (event) {
        if (event.target.classList.contains("modal")) {
            event.target.style.display = "none";
            document.body.style.overflow = "auto";
        }
    };
};