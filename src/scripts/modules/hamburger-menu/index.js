const hmbBtns = document.querySelectorAll('.js-hmb-btn'); // 複数のボタンを取得
const menu = document.querySelector('.menu-sp');
let isOpen = false;

/**
 * メニューを開く処理を行います。
 */
const open = () => {
  const allBtns = document.querySelectorAll('.js-hmb-btn'); // 動的にクローン要素も含めて取得
  allBtns.forEach((btn) => btn.classList.add('active')); // 全てのボタンにクラスを追加
  menu.classList.add('open');
  document.body.classList.add('is-menu-open');
  document.body.style.overflow = 'hidden';
  isOpen = true;
};

/**
 * メニューを閉じる処理を行います。
 */
const close = () => {
  const allBtns = document.querySelectorAll('.js-hmb-btn'); // 動的にクローン要素も含めて取得
  allBtns.forEach((btn) => btn.classList.remove('active')); // 全てのボタンのクラスを削除
  menu.classList.remove('open');
  document.body.classList.remove('is-menu-open');
  document.body.style.overflow = 'visible';
  isOpen = false;
};

/**
 * クローンヘッダー内のハンバーガーボタンにもイベントを追加します。
 */
const addHmbEventsToClone = () => {
  const cloneBtns = document.querySelectorAll('#header-clone .js-hmb-btn'); // クローン内のボタン
  cloneBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      if (isOpen) {
        close();
      } else {
        open();
      }
    });
  });
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

  // クローンヘッダーが作成された場合にイベントを登録
  const observer = new MutationObserver(() => {
    if (document.querySelector('#header-clone')) {
      addHmbEventsToClone(); // クローンが存在したらイベントを登録
      observer.disconnect(); // イベント登録が終わったら監視を終了
    }
  });

  observer.observe(document.body, {
    childList: true,
    subtree: true, // 子孫ノードも監視
  });
};