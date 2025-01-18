export const initProduct = () => {
  document.querySelectorAll('.product-list__toggle').forEach(toggle => {
      const wrap = toggle.closest('.product-list__wrap');
      const detail = wrap.querySelector('.product-list__detail');
      
      // 3行分の高さを計算
      const lineHeight = parseInt(window.getComputedStyle(detail).lineHeight);
      const maxHeight = lineHeight * 3;

      if (detail.scrollHeight > maxHeight) {
          toggle.style.display = 'block';
          
          toggle.addEventListener('click', () => {
              wrap.classList.toggle('is-open');
          });
      }
  });
}