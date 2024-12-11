/**
 * クローンヘッダー要素を作成します。
 * @return {HTMLElement} クローンヘッダー要素
 */
const createCloneHeader = () => {
  const cloneHeader = document.getElementById('header').cloneNode(true)

  cloneHeader.id = 'header-clone'
  cloneHeader.classList.add('header--clone')
  cloneHeader.classList.add('hidden')

  return cloneHeader
}

/**
 * クローンヘッダーを初期化します。
 */
export const initCloneHeader = () => {
  const cloneHeader = createCloneHeader()
  const wrapElement = document.querySelector('.wrap')

  wrapElement.insertBefore(cloneHeader, wrapElement.firstChild)

  let prevScrollTop = 0
  window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop
    const headerHeight = document.getElementById('header').offsetHeight
    const isDown = scrollTop > prevScrollTop

    if (isDown) {
      cloneHeader.classList.add('hidden')
    } else {
      cloneHeader.classList.remove('hidden')
    }

    if (headerHeight > scrollTop) {
      cloneHeader.classList.add('is-top')
    } else {
      cloneHeader.classList.remove('is-top')
    }

    prevScrollTop = scrollTop
  })
}
