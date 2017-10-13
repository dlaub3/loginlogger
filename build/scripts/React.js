import React from 'react';
import ReactDOM from 'react-dom';
import App from './components/App.jsx';
import Promise from 'promise-polyfill';
import { Provider } from 'react-redux';
import store from './store';

// Polyfill for older browsers
// This is used with fetch
if (!window.Promise) {
  window.Promise = Promise;
}

ReactDOM.render(<Provider store={store}><App /></Provider>, document.getElementById('app'));
