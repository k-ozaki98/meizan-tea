import {
  initContact
} from './pages/contact';
import {
  initTop
} from './pages/top'
import {
  initCommon
} from './common'
import {
  renderReactApp
} from './react';
import TopApp from "./react/TopApp";

import {
  gsap
} from 'gsap'
import {
  ScrollTrigger
} from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

document.addEventListener('DOMContentLoaded', () => {
  const pageId = document.querySelector('body').getAttribute('data-pageid')
  const isTop = pageId === 'top';
  if (isTop) {
    initTop() // トップページ用スクリプト
    // renderReactApp('js-react-app', TopApp)
  }


  const isContact = pageId === 'contact';
  if (isContact) {
    initContact();
  }

  const navItems = document.querySelectorAll('.header__nav-item');

  if (!pageId || !navItems.length) return;

  navItems.forEach(item => {
    const navId = item.getAttribute('data-nav-id');
    if (navId === pageId) {
      item.classList.add('is-active');
    }
  })

  initCommon()
})