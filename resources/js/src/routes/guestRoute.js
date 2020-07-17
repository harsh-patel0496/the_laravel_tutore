import React from 'react';
import { Route,Redirect } from 'react-router-dom';

const GuestRoute = ({component:Component, ...rest}) => {
    const token = localStorage.getItem('user');
    return (
        <Route
            {...rest}
            render = {
                props => !Boolean(token) ? 
                    (
                        <Component {...props} />
                    ) : 
                    (
                        <Redirect 
                            to={{ pathname: "/", state: { from: props.location }}} 
                        />
                    ) 
                }
        />
    )
}

export default GuestRoute
