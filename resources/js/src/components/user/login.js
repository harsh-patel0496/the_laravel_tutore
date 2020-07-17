import React,{useState} from 'react';
import { connect } from 'react-redux';
import '../../assert/css/form.css';
import { fetchUser } from '../../reducers/actions/fetchUser'
import  Button  from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';

function Login(props) {
    console.log(props)
    const initialState = {
        email: "",
        password: ""
    };
    const [user,setUser] = useState(initialState)

    const handleChange = (e) => {
        setUser({...user,[e.target.name]:e.target.value});
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        props.fetchUser(user).then( response => {
            console.log(response);
            props.history.push('/multiStepForm');
        }).catch( error => {
            console.log(error);
        })
    }

    return (
        <div>
            
            <center>
                <h2>Login</h2>
                <Form onSubmit = {handleSubmit} className = "inputField">
                    <Form.Group controlId="formBasicEmail">
                        <Form.Control type="text" 
                            placeholder="Enter email"  
                            name="email" 
                            value={user.email} 
                            onChange={handleChange} 
                        />
                        {/* <Form 
                            type="text" 
                           
                            placeholder="Email" 
                            className = "inputField"
                        /> */}
                    </Form.Group>
                    <Form.Group controlId="formBasicPassword"> 
                        <Form.Control 
                            type="password" 
                            name="password" 
                            value={user.password} 
                            onChange={handleChange} 
                            placeholder="Password"
                            className = "inputField"
                        />
                    </Form.Group>
                    <Button type="submit" variant="primary">Login</Button>
                </Form>
            </center>
        </div>
    )
}

const mapStateToProps = state => {
    return { auth : state.auth }
}

const mapDispatchToProps = dispatch => {
    return {
        fetchUser: user => dispatch(fetchUser(user))
    }
}
export default connect(mapStateToProps,mapDispatchToProps)(Login)
