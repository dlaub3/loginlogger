import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App.jsx';
import Promise from 'promise-polyfill';

// Polyfill for older browsers
// This is used with fetch
if (!window.Promise) {
  window.Promise = Promise;
}

ReactDOM.render(<App />, document.getElementById('app'));
