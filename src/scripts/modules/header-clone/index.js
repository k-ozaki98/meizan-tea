/**
 * 指定したIDの要素をクローンし、そのクローン要素を返します。
 *
 * @param {string} id - クローンしたい要素のID。
 * @return {HTMLElement} クローンされたヘッダー要素。
 */
const createCloneHeader = (id) => {
  const existingClone = document.getElementById(`${id}-clone`);
  if (existingClone) {
    return existingClone; // すでにクローンが存在する場合はそれを返す
  }

  const cloneHeader = document.getElementById(id).cloneNode(true);

  cloneHeader.id = `${id}-clone`;
  cloneHeader.classList.add(`${id}--clone`);
  cloneHeader.classList.add('hidden');

  return cloneHeader;
}

/**
 * 指定したIDの要素をクローンし、スクロール位置に基づいてクローン要素の表示・非表示を切り替えるイベントを設定します。
 *
 * @param {string} [id='header'] - クローンおよび初期化したいヘッダー要素のID（デフォルトは'header'）。
 */
export const initCloneHeader = (id = 'header') => {
  const originalHeader = document.getElementById(id); // 最初のヘッダー
  const cloneHeader = createCloneHeader(id); // クローンヘッダー
  const wrapElement = document.querySelector('.wrap');

  // クローンヘッダーがまだ追加されていない場合に追加
  if (!wrapElement.contains(cloneHeader)) {
    wrapElement.insertBefore(cloneHeader, wrapElement.firstChild);
  }

  let prevScrollTop = 0;
  window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const headerHeight = originalHeader.offsetHeight;

    // スクロール位置が前の位置より上の場合
    if (scrollTop < prevScrollTop) {
      cloneHeader.classList.remove('hidden'); // クローンヘッダーを表示
      originalHeader.classList.add('hidden'); // 最初のヘッダーを非表示
    }

    // スクロール位置が下に向かっている場合（何もしないことで常に表示）
    if (scrollTop > prevScrollTop) {
      cloneHeader.classList.remove('hidden'); // クローンヘッダーを表示
      originalHeader.classList.add('hidden'); // 最初のヘッダーを非表示
    }

    // スクロール位置がヘッダーの高さ以内なら is-top クラスを追加
    if (headerHeight > scrollTop) {
      cloneHeader.classList.add('is-top');
      originalHeader.classList.remove('hidden');
    } else {
      cloneHeader.classList.remove('is-top');
    }

    // 現在のスクロール位置を記録
    prevScrollTop = scrollTop;
  });
}