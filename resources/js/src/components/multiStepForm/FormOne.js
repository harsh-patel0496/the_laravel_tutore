import React,{ useState,useContext,useRef } from 'react'
import { StepContext } from '.';
import { connect } from 'react-redux';
import '../../assert/css/form.css';

function FormOne(props) {
    const { step,nextStep } = useContext(StepContext)
    const cat_type = ["Configurable","Simple"];
    const initialValues = {
        email: '',
        password: '',
        type: '',
        image: {}
    }
    const [values,setValues] = useState(initialValues)
    const fileRef = useRef(null);
    let formData = new FormData()
    const handleChange = (e) => {
        const name = e.target.name
        const value = e.target.value
        setValues({...values,[name]:value})
        formData.set([name],value);
        if(fileRef.current && fileRef.current.name === 'image' && fileRef.current.files[0]){
            console.log(fileRef.current.files[0]);
            //setValues({...values,[fileRef.current.name]:fileRef.current.files[0]})
            //let reader = new FileReader();
            // reader.onload = (e)=> {
            //     // add the file to the array
            //     setValues({...values,image:e.target.result})
            // }
            // reader.readAsDataURL(fileRef.current.files[0]);
            
        }
        

    }
    const handleSubmit = (event) => {
        
        event.preventDefault();
        const formdata = new FormData();
        const keys = Object.keys(values);
        const value = Object.values(values);
        for (let i = 0; i < keys.length; i += 1) {
            formdata.append(keys[i], value[i]);
        }
        formdata.append(fileRef.current.name,fileRef.current.files[0])
        console.log(props)
        const reqOptions = {
            method: 'POST',
            url: "/api/user/save",
            data: formdata,
            headers: {
                Authorization: `Bearer ${props.auth.access_token}`
            }
        } 
        console.log(formdata)
        axios(reqOptions).then((res) => {
            console.log('Reaponse',res)
        }).catch((err) => {
            console.log(err.message)
        })

        // function formdataCoverter(payload) {
        //     const formdata = new FormData();
        //     const keys = Object.keys(payload);
        //     const values = Object.values(payload);
        //     for (let i = 0; i < keys.length; i += 1) {
        //       formdata.append(keys[i], values[i]);
        //     }
        //     return formdata;
        //   }
        
        //   function onFileDropLogo(acceptedFile) {
        //     setState((prevState) => ({
        //       ...prevState,
        //       logo: acceptedFile[0],
        //       logoPreview: URL.createObjectURL(acceptedFile[0]),
        //     }));
        //   }
        //nextStep();
    }
    return (
        <div>
            Step {step} <br />
            <form onSubmit={handleSubmit} encType="multipart/form-data">
                <input 
                    type='text' 
                    name='name' 
                    value={values.name} 
                    onChange={handleChange}
                    className = "inputField"
                    placeholder = "Name"
                /><br /><br />
                <input 
                    type='text' 
                    name='description' 
                    onChange={handleChange} 
                    value={values.description}
                    className = "inputField"
                    placeholder = "Description"
                /><br /><br />
                <select name='type' onChange={handleChange} value={values.type} className = "inputField">
                    <option>Select</option>
                    {cat_type.map((cat,index) => (<option key={index} value={index}>{cat}</option>))}
                </select><br /><br />
                {/* <input type='password' name='name'/><br /> */}
                <input 
                    type='file' 
                    ref={fileRef} 
                    onChange={handleChange} 
                    name='image'
                    className = "inputField"
                />
                <br />
                <button type='submit' className = "fancyButton success">Next</button>
            </form>
        </div>
    )
}

const mapStateToProps = state => {
    return { auth: state.auth.user }
}

export default connect(mapStateToProps)(FormOne)
