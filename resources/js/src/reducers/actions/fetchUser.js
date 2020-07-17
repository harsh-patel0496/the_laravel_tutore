import axios from 'axios'


export const fetchUser = (user) => {
    return (dispatch) => {
        const options = {
            method: "POST",
            url: "http://localhost:8000/api/user/login",
            data: user
        }

        return new Promise((resolve,reject) => {
            axios(options).then((user) => {
                // axios.get("api/passport").then((token) => {
                //     console.log(token);
                // }).catch((error) => {
                //     console.log('error');
                // })
                // dispatch({type:"SET_LOGIN",payload:user.data});
                // localStorage.setItem('user',JSON.stringify(user.data));
                resolve(user)
            }).catch((error) => {
                console.log(error)
                reject(error)
            });
        });
        
    }
}