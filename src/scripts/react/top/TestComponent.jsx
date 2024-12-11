import { useState } from 'react'

// ↓↓↓読み込み方↓↓↓
// 
// import React from 'react'
// import ReactDOM from 'react-dom/client'
// import コンポーネント名 from './コンポーネント名'
// ReactDOM.createRoot(document.getElementById('レンダリングする要素名')).render(
//   <React.StrictMode>
//     <コンポーネント名 />
//   </React.StrictMode>
// )

function TestComponent() {

  const [text, setText] = useState('テストコンポーネント。クリックでテキスト変更。')

  const clickBundle = () => {
    setText('テストコンポーネント。テキスト変更されました。')
  }

  return (
    <>
      <p onClick={clickBundle}>{ text }</p>
    </>
  )
}

export default TestComponent
