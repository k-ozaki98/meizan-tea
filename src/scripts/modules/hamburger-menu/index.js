const hmbBtns = document.querySelectorAll('.js-hmb-btn'); // 複数のボタンを取得
const menu = document.querySelector('.menu-sp');
let isOpen = false;

/**
 * メニューを開く処理を行います。
 */
const open = () => {
  hmbBtns.forEach((btn) => btn.classList.add('active')); // 全てのボタンにクラスを追加
  menu.classList.add('open');
  document.body.classList.add('is-menu-open');
  document.body.style.overflow = 'hidden';
  isOpen = true;
};

/**
 * メニューを閉じる処理を行います。
 */
const close = () => {
  hmbBtns.forEach((btn) => btn.classList.remove('active')); // 全てのボタンのクラスを削除
  menu.classList.remove('open');
  document.body.classList.remove('is-menu-open');
  document.body.style.overflow = 'visible';
  isOpen = false;
};

/**
 * ハンバーガーメニューを初期化します。
 */
export const initHmbMenu = () => {
  if (!hmbBtns.length) return; // ボタンが存在しない場合は終了

  // 各ボタンにクリックイベントを設定
  hmbBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      if (isOpen) {
        close();
      } else {
        open();
      }
    });
  });
};