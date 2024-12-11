import { initTop } from './pages/top'
import { renderReactApp } from './react';
import TopApp from "./react/TopApp";

import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    initTop() // トップページ用スクリプト
    // renderReactApp('js-react-app', TopApp)
  }
})
