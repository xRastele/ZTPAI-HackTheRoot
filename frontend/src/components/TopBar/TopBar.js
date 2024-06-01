import React, { useState, useEffect, useRef } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './TopBar.css';
import searchIcon from '../../assets/search_icon.svg';
import profilePic from '../../assets/placeholder_profile.png';

const TopBar = () => {
    const [userData, setUserData] = useState(null);
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const navigate = useNavigate();
    const dropdownRef = useRef(null);

    const handleLogout = () => {
        localStorage.removeItem('Authorization');
        navigate('/logout');
    };

    const toggleDropdown = () => setDropdownOpen(!dropdownOpen);

    const handleClickOutside = (event) => {
        if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
            setDropdownOpen(false);
        }
    };

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
    },[]);

    useEffect(() => {
        document.addEventListener("mousedown", handleClickOutside);
        return () => {
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, []);

    return (
        <div className="topbar">
            <div className="search-bar">
                <input type="text" placeholder="Search..." style={{backgroundImage: `url(${searchIcon})`}} />
            </div>
            <div className="user-info">
                <span className="user-points">Points: {userData ? userData.points : ''}</span>
                <div className="user-nickname" onClick={toggleDropdown} ref={dropdownRef}>
                    <img src={profilePic} alt="Profile" />
                    {userData ? userData.username : ''}
                    {dropdownOpen &&
                        <div className="dropdown-menu">
                            <div className="dropdown-item" onClick={handleLogout}>Logout</div>
                        </div>
                    }
                </div>
            </div>
        </div>
    );
};

export default TopBar;