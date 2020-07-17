import React from 'react'
import { useHistory } from 'react-router-dom'
function Welcome() {
    let history = useHistory()
    return (
        <div>
            <h1>Welcome</h1>
            <button onClick={() => history.push('/multiStepForm')}>Multi Step Form</button>
        </div>
    )
}

export default Welcome
