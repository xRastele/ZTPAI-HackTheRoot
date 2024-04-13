import React from 'react';
import './TopBar.css';
import searchIcon from './search_icon.svg';
import profilePic from './placeholder_profile.png'; // zaimportuj obrazek profilowy

const TopBar = () => {
    return (
        <div className="topbar">
            <div className="search-bar">
                <input type="text" placeholder="Search..." style={{backgroundImage: `url(${searchIcon})`}} />
            </div>
            <div className="user-info">
                <span className="user-points">Points: 100</span>
                <a href="#" className="user-nickname">
                    <img src={profilePic} alt="Profile" />
                    Username
                </a>
            </div>
        </div>
    );
};

export default TopBar;