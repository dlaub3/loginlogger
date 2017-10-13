import {compose, combineReducers, applyMiddleware, createStore} from 'redux';
import {persistStore, autoRehydrate} from 'redux-persist';
import { composeWithDevTools } from 'redux-devtools-extension';

// The login reducer
const initialLoginState = {
  auth: false
}

const loginReducer = (state = initialLoginState, action) => {
  switch(action.type) {
  case 'LOGIN':
    return Object.assign({}, state, { auth: action.auth });
  }
  return state;
}

//The bootstrap reducer
const initialBoostrapState = {
  tables: true
}

const bootstrapReducer = (state = initialBoostrapState, action) => {
  switch(action.type) {
  case 'BOOTSTRAP':
    return Object.assign({}, state, { tables: action.bootstrap });
  }
  return state;
}

// Combine Reducers
const reducers = combineReducers({
  loginState: loginReducer,
  bootstrapState: bootstrapReducer
});

const store = createStore(reducers, composeWithDevTools(autoRehydrate()));

export default store;
