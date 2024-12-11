import { initHmbMenu } from './modules/hamburger-menu'
import { initPageTop } from './modules/page-top'
import { initCloneHeader } from './modules/header-clone'
import { PAGETOP_IN_TRIGGER } from './config'


export const initCommon = () => {
  initHmbMenu()
  initPageTop('js-pagetop', PAGETOP_IN_TRIGGER)
  initCloneHeader() // 不要なら削除してください  

};
