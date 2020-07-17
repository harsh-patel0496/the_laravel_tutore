import { createStore,applyMiddleware } from 'redux';
import RootReducer from '../reducers/rootReducer';
import thunk from 'redux-thunk'
import { composeWithDevTools } from 'redux-devtools-extension'

const store = createStore(RootReducer,composeWithDevTools(applyMiddleware(thunk)));

export default store;