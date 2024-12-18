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
  initCloneHeader
} from './modules/header-clone'
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
  const headerTop = document.getElementById('#header');
  if (isTop) {
    initTop() // トップページ用スクリプト
    // renderReactApp('js-react-app', TopApp)
    initCloneHeader()
  }


  const isContact = pageId === 'contact';
  if (isContact) {
    initContact();
  }

  const navItems = document.querySelectorAll('.header__nav-item');

  if (!pageId || !navItems.length) return;

  navItems.forEach(item => {
    const navId = item.getAttribute('data-nav-id');
    if (navId === pageId || (pageId === 'product' && navId === 'products')) {
      item.classList.add('is-active');
    }
  })

  initCommon();

})