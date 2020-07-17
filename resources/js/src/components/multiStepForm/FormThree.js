import React,{ useContext } from 'react'
import { StepContext } from '.';

function FormThree() {
    const { step,reset } = useContext(StepContext)
    return (
        <div>
            Step {step} <br />
            <button onClick={reset}>Submit</button>
        </div>
    )
}

export default FormThree