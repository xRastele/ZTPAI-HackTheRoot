import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './TopBar.css';
import searchIcon from '../../assets/search_icon.svg';
import profilePic from '../../assets/placeholder_profile.png';

const TopBar = () => {
    const [userData, setUserData] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const token = localStorage.getItem('Authorization');
        axios.get('https://localhost:8000/api/user', {
            headers: {
                "Authorization": `${token}`
            }
        })
            .then(response => setUserData(response.data))
            .catch(error => {
                console.error(error);
                navigate('/login');
            });
    }, []);

    return (
        <div className="topbar">
            <div className="search-bar">
                <input type="text" placeholder="Search..." style={{backgroundImage: `url(${searchIcon})`}} />
            </div>
            <div className="user-info">
                <span className="user-points">Points: {userData ? userData.points : ''}</span>
                <a href="#" className="user-nickname">
                    <img src={profilePic} alt="Profile" />
                    {userData ? userData.username : ''}
                </a>
            </div>
        </div>
    );
};

export default TopBar;