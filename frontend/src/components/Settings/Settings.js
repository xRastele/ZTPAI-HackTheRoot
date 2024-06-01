import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Settings.css';

const maskEmail = (email) => {
    const emailParts = email.split('@');
    const localPart = emailParts[0];
    const domainPart = emailParts[1];

    if (localPart.length > 2) {
        return localPart[0] + '*****' + localPart[localPart.length - 1] + '@' + domainPart;
    } else {
        return email;
    }
};

const Settings = () => {
    const [data, setData] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const token = localStorage.getItem('Authorization');
        axios.get('https://localhost:8000/api/settings', {
            headers: {
                "Authorization": `${token}`
            }
        })
            .then(response => setData(response.data))
            .catch(error => {
                console.error(error);
                navigate('/login');
            });
    }, []);

    if (!data) {
        return <div>Loading...</div>;
    }

    return (
        <div className="settings-page">
            <div className="settings-content">
                <p><b>Email:</b> {maskEmail(data.email)}</p>
                <p><b>Referral Code:</b> {data.referral_code}</p>
                <p><b>Invited Friends:</b> {data.referral_count}</p>
            </div>
        </div>
    );
};

export default Settings;