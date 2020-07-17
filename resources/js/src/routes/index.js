import React from 'react'
import { Switch, Route } from 'react-router-dom'
import Welcome from '../components/Welcome'
import MultiStepForm from '../components/multiStepForm';
import GuestRoute from './guestRoute'
import PrivateRoute from './privateRoute'
import {Login} from '../components/user'
function Routes() {
    return (
        <Switch>
            <PrivateRoute path='/' component={Welcome} exact/>
            <GuestRoute path="/login" component={Login} exact />
            <PrivateRoute path="/multiStepForm" component = {MultiStepForm} exact/>
        </Switch>
    )
}

export default Routes