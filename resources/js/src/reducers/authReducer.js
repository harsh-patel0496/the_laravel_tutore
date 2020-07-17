const initialState = {
    isLoggedIn: false,
    user: {}
}

const AuthReducer = (state = initialState,actions) => {

    switch(actions.type){
        case 'SET_LOGIN':
            return {...state,isLoggedIn:true,user: actions.payload};
        default:
            return state;
    }

}

export default AuthReducer;