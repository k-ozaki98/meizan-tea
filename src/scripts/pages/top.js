export const initTop = () => {
  window.addEventListener('load', () => {
    const mvTtl = document.querySelector('.mv__ttl');
    mvTtl.classList.add('visible'); // ページが読み込まれた後にアニメーションを開始
  });

  const swiper = new Swiper('.swiper', {
    effect: 'fade',
    speed: 5000,
    autoplay: {
      delay: 2000,
    },
    fadeEffect: {
      crossFade: true
    },
  });
}