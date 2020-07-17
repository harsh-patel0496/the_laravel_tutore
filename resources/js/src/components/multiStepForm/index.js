import React,{ useState,useEffect,useContext } from 'react'
import FormOne from './FormOne';
import FormTwo from './FormTwo';
import FormThree from './FormThree';

export const StepContext = React.createContext()

function MultiStepForm() {

    const [step,setStep] = useState(1)

    const nextStep = () => {
        setStep( step + 1)
    }

    const prevStep = () => {
        setStep( step - 1)
    }
    const reset = () => {
        setStep(1)
    }

    return (
        <div>
            <StepContext.Provider value = {{step,prevStep,nextStep,reset}}>
                {step === 1 && <FormOne />}
                {step === 2 && <FormTwo />}
                {step === 3 && <FormThree />}
            </StepContext.Provider>
        </div>
    )
}

export default MultiStepForm
