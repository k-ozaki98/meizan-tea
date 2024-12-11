import "./react-common.scss"

import React from "react";
import ReactDOM from "react-dom/client";

/**
 * 指定されたDOMコンテナにReactコンポーネントまたは要素をレンダリングします。
 * @param {string} id - DOMコンテナのIDです。
 * @param {React.Component|JSX.Element} Components - レンダリングするReactコンポーネントまたは要素です。
 */
export const renderReactApp = (id, Components) => {
  if(!document.getElementById(id)) return;
  ReactDOM.createRoot(document.getElementById(id)).render(
    <React.StrictMode>
      <Components />
    </React.StrictMode>
  );
}