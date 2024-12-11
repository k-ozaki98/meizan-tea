import { findData, normalize } from './utils'
import observer from './canvas-player-observer'
import Loader from './canvas-player-loader'

export default class {
  canvasDOM
  ctx

  #data = []
  #currentData = null

  #targetFrame
  #currentFrame
  #playState = 0

  /**
   * クラスのコンストラクタです。
   * @param {string} id - canvas要素のID名
   */
  constructor(id) {
    this.canvasDOM = document.getElementById(id)
    this.ctx = this.canvasDOM.getContext('2d')

    this.#onResize()
  }

  /**
   * 再生状態を返します。
   * @returns {number}
   */
  getPlayState() {
    return this.#playState
  }

  /**
   * 現在の動画IDを返します。
   * @returns {string[]}
   */
  getVideoIds() {
    return this.#data.map((e) => e.id)
  }

  /**
   * 現在の動画のフレーム枚数を返します。
   * @returns {number}
   */
  getImgCount() {
    if (!this.#currentData) return
    return this.#currentData.imgCount
  }

  /**
   * イベントリスナーを登録します。
   * @param {string} eventName - イベント名。現在は"loading"と"playing"イベントのみをサポートしています。
   * @param {void} callback - コールバック関数
   */
  on(eventName, callback) {
    switch (eventName) {
      case 'loading':
        observer.on(eventName, callback)
        break

      case 'playing':
        observer.on(eventName, callback)
        break

      default:
        console.error(
          `This event name "${eventName}" can't be used. Supported event name is "loading" or "playing".`
        )
        break
    }
  }

  /**
   *
   * @typedef {Object} loadAttr
   * @property {string} id - 登録する動画のID名
   * @property {string} imgDir - フレーム画像格納フォルダのパス
   * @property {string} imgExt - フレーム画像の拡張子
   * @property {number} imgCount - フレーム画像の数
   * @property {number} fps - フレームレート
   */
  /**
   * 動画データを読み込みます。
   * @param {loadAttr} options - {id, imgDir, imgExt, imgCount, fps}
   */
  load(options = {}) {
    const id = options.id || 'default'
    if (findData(id, this.#data)) return

    let imgDir = options.imgDir || this.canvasDOM.dataset.img_dir || ''
    if (window.innerWidth < 768) {
      imgDir =
        options.imgDir ||
        this.canvasDOM.dataset.img_dir_sp ||
        this.canvasDOM.dataset.img_dir
    }
    const imgExt = options.imgExt || this.canvasDOM.dataset.img_ext || 'jpg'
    const imgCount =
      options.imgCount || Number(this.canvasDOM.dataset.img_count) || 0
    const fps = options.fps || Number(this.canvasDOM.dataset.fps) || 30

    const opts = {
      id,
      imgDir,
      imgExt,
      imgCount,
      fps
    }
    this.#data.push({
      id,
      loaderInstance: new Loader(opts)
    })

    if (this.#currentData === null) {
      // 初回のみ
      this.changeCurrentData(opts.id)
      this.#render()
    }
  }

  /**
   * 進捗率（0～1に正規化された値）に基づいてプレーヤーを再生します。
   * @param {number} progress - 進捗率
   */
  playWithProgress(progress) {
    if (this.#playState || this.#currentData === null) return
    this.#targetFrame = Math.floor((progress / this.#currentData.rate) * 100)
  }

  /**
   * 現在の動画データを変更します。
   * @param {string} id - 登録した動画ID
   */
  changeCurrentData(id) {
    const currentData = findData(id, this.#data).loaderInstance;
    if (!currentData) return

    this.#currentData = currentData
    this.#targetFrame = 0
    this.#currentFrame = -1

    this.pause()
  }

  /**
   *
   * @typedef {Object} playAttr
   * @property {boolean} reverse - 逆再生するか
   * @property {boolean} loop - 繰り返し再生するか
   */
  /**
   * 動画を再生します。
   * @param {playAttr} options
   */
  play(options = {}) {
    if (this.#playState === 1) return
    this.#playState = 1
    this.#moveFrame(options)
  }

  /**
   * 動画を停止します。
   */
  pause() {
    this.#playState = 0
  }

  /**
   * 指定したフレームに移動します
   * @param {number} frameNumber
   */
  seekTo(frameNumber = 0) {
    if (!this.#currentData || !this.#currentData.frameData[frameNumber]) return
    this.#currentFrame = frameNumber
    this.#targetFrame = frameNumber
    this.#drawFrame(this.#currentData.frameData[frameNumber])
  }

  /**
   * 次のフレームに進みます。
   */
  nextFrame() {
    if (this.#targetFrame >= this.#currentData.imgCount - 1) return
    this.#targetFrame++
  }

  /**
   * 前のフレームに戻ります。
   */
  prevFrame() {
    if (this.#targetFrame < 0) return
    this.#targetFrame--
  }

  #getNextFrame() {
    let nextFrame = this.#targetFrame
    const diff = nextFrame - this.#currentFrame
    if (diff > 1) {
      nextFrame = this.#currentFrame + 1
    } else if (diff < -1) {
      nextFrame = this.#currentFrame - 1
    }
    return nextFrame
  }

  #setSize() {
    this.canvasDOM.height = this.ctx.canvas.clientHeight
    this.canvasDOM.width = this.ctx.canvas.clientWidth
  }

  #onResize() {
    let resizeTimer = false
    let previousWidth = window.innerWidth
    this.#setSize()
    window.addEventListener('resize', () => {
      if (!this.#currentData) return
      if (window.innerWidth !== previousWidth) {
        this.canvasDOM.style.opacity = 0
        resizeTimer = setTimeout(() => {
          if (resizeTimer !== false) {
            clearTimeout(resizeTimer)
          }
          this.#setSize()
          const currentFrameData =
            this.#currentData.frameData[this.#currentFrame]
          if (!currentFrameData || !currentFrameData.complete) return
          this.#drawFrame(currentFrameData)
          this.canvasDOM.style.opacity = 1
        }, 500)
      }
      previousWidth = window.innerWidth
    })
  }

  #moveFrame(options) {
    let stopIndex = this.#currentData.imgCount - 1
    if (options.reverse) {
      stopIndex = 0
    }

    if (this.#currentData.loadProgress < 0.5) return
    if (this.#playState === 0) return
    if (stopIndex === this.#targetFrame) {
      if (options.loop) {
        const nextIndex = options.reverse ? this.#currentData.imgCount - 1 : 0
        this.#currentFrame = nextIndex
        this.#targetFrame = nextIndex
      } else {
        this.#playState = 0
        return
      }
    }

    if (stopIndex > this.#targetFrame) {
      this.nextFrame()
    } else {
      this.prevFrame()
    }
    requestAnimationFrame(this.#moveFrame.bind(this, options))
  }

  #render() {
    requestAnimationFrame(this.#render.bind(this))

    if (this.#currentFrame === this.#targetFrame) return

    const nextFrame = this.#getNextFrame()
    const nextFrameData = this.#currentData.frameData[nextFrame]

    if (!nextFrameData || !nextFrameData.complete) return

    this.#drawFrame(nextFrameData)
    this.#currentFrame = nextFrame

    observer.trigger('playing', {
      videoId: this.#currentData.id,
      playProgress: normalize(
        this.#currentFrame,
        0,
        this.#currentData.imgCount - 1
      )
    })
  }

  #drawFrame(targetFrameData) {
    this.ctx.clearRect(
      0,
      0,
      this.ctx.canvas.clientWidth,
      this.ctx.canvas.clientHeight
    )
    this.ctx.drawImage(
      targetFrameData.img,
      0,
      0,
      this.ctx.canvas.clientWidth,
      this.ctx.canvas.clientHeight
    )
  }
}
