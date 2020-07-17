import React,{ useContext } from 'react'
import { StepContext } from '.';

function FormTwo() {
    const { step,nextStep,prevStep } = useContext(StepContext)
    return (
        <div>
            Step {step} <br />
            <button onClick={prevStep}>Prev</button><button onClick={nextStep}>Next</button>
        </div>
    )
}

export default FormTwo