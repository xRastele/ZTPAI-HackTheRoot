import React from 'react';
import { Link } from 'react-router-dom';
import './Register.css';
import logo from '../../assets/logo.svg';

const Register = () => {
    return (
        <div className="login-page">
            <img src={logo} alt="Logo" className="logo" />
            <div className="content">
                <div className="register-form-container">
                    <form className="register-form">
                        <input type="email" placeholder="Email" required />
                        <input type="text" placeholder="Username" required />
                        <input type="password" placeholder="Password" required />
                        <input type="password" placeholder="Confirm Password" required />
                        <button type="submit">Register</button>
                    </form>
                    <p>If you already have an account, <Link to="/login" className="login-link">login here</Link></p>
                </div>
            </div>
        </div>
    );
};

export default Register;