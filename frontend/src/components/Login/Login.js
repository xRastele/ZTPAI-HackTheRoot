import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import './Login.css';
import logo from '../../assets/logo.svg';
import axios from 'axios';

async function loginUser(username, password) {
    let url = `https://localhost:8000/api/login_check`;
    let send = {
        "username": username,
        "password": password
    }

    try {
        const response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(send),
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        });

        const data = await response.json();

        if(data.token) {
            localStorage.setItem('Authorization', `Bearer ${data.token}`);
        }

        return data.token;
    } catch(error) {
        console.error("Login failed:", error);
        return null;
    }
}

const Login = () => {
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');

    const handleLogin = async (event) => {
        event.preventDefault();

        try {
            const token = await loginUser(username, password);
            console.log('User logged in, token:', token);
        } catch (error) {
            console.error('Login failed:', error);
        }
    };

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
                    <form className="login-form" onSubmit={handleLogin}>
                        <input type="text" placeholder="Username" required value={username} onChange={e => setUsername(e.target.value)} />
                        <input type="password" placeholder="Password" required value={password} onChange={e => setPassword(e.target.value)} />
                        <button type="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    );
};

export default Login;