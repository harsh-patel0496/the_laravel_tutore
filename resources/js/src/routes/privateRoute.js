import React from 'react'
import {Route,Redirect } from 'react-router-dom';

const PrivateRoute = ({component:Component,...rest}) => {
    const token = localStorage.getItem('user');
    return (
        <Route 
            {...rest}
            render = { (props) => Boolean(token) ? (<Component {...rest} />) : (<Redirect to={{pathname:'/login'}}/>)
                
            }
        />
    )
}

export default PrivateRoute
