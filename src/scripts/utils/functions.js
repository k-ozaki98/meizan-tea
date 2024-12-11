/**
 * ページトップボタンの表示条件を定義するスクロール位置の閾値です。
 * この値を超えたスクロール位置でページトップボタンが表示されます。
 * @type {number}
 */
export const PAGETOP_IN_TRIGGER = 800

/**
 * ページトップボタンを初期化します。
 */
export const initPageTop = () => {
  const pagetop = document.getElementById('js-pagetop')

  /**
   * ページトップボタンがクリックされたときにページの先頭までスクロールします。
   * @param {Event} event - クリックイベントオブジェクト。
   */
  pagetop.addEventListener('click', (event) => {
    event.preventDefault()
    scrollToTop()
  })

  /**
   * ウィンドウのスクロールイベントを監視し、スクロール位置に応じてページトップボタンの表示状態を切り替えます。
   */
  window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop
    const isDown = scrollTop > PAGETOP_IN_TRIGGER

    if (isDown) {
      pagetop.classList.add('active')
    } else {
      pagetop.classList.remove('active')
    }
  })
}

/**
 * ページの先頭までスクロールします。
 */
const scrollToTop = () => {
  const scrollOptions = {
    top: 0,
    behavior: 'smooth'
  }
  window.scrollTo(scrollOptions)
}
