import React from 'react';
import { Link } from 'react-router-dom';
import './Login.css';
import logo from '../../assets/logo.svg';

const Login = () => {
    return (
        <div className="login-page">
            <img src={logo} alt="Logo" className="logo" />
            <div className="content">
                <div className="left-side">
                    <h1>MASTER CYBERSECURITY</h1>
                    <p>Practice vulnerabilities with challenges<br />and improve your hacking skills</p>
                    <Link to="/register" className="start-button">Start learning</Link>
                </div>
                <div className="right-side">
                    <form className="login-form">
                        <input type="email" placeholder="Email" required />
                        <input type="password" placeholder="Password" required />
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login;