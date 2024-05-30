import React, {useState} from 'react';
import { Link } from 'react-router-dom';
import './Register.css';
import logo from '../../assets/logo.svg';
import axios from "axios";

const Register = () => {
    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [error, setError] = useState('');
    const [success, setSuccess] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();
        setError('');
        setSuccess('');

        if (password !== confirmPassword) {
            setError('Passwords do not match.');
            return;
        }

        try {
            const response = await axios.post('https://localhost:8000/api/register', {
                username,
                email,
                password
            });

            if (response.status === 201) {
                setSuccess('Please check your email to confirm your registration');
                setUsername('');
                setEmail('');
                setPassword('');
                setConfirmPassword('');
            }
        } catch (error) {
            setError('An error occurred during registration.');
        }
    };

    return (
        <div className="login-page">
            <img src={logo} alt="Logo" className="logo" />
            <div className="content">
                <div className="register-form-container">
                    {error && <p className="error">{error}</p>}
                    {success && <p className="success">{success}</p>}
                    <form className="register-form" onSubmit={handleSubmit}>
                        <input type="email" placeholder="Email" required onChange={e => setEmail(e.target.value)} />
                        <input type="text" placeholder="Username" required onChange={e => setUsername(e.target.value)} />
                        <input type="password" placeholder="Password" required onChange={e => setPassword(e.target.value)} />
                        <input type="password" placeholder="Confirm Password" required onChange={e => setConfirmPassword(e.target.value)} />
                        <button type="submit">Register</button>
                    </form>
                    <p>If you already have an account, <Link to="/login" className="login-link">login here</Link></p>
                </div>
            </div>
        </div>
    );
};

export default Register;