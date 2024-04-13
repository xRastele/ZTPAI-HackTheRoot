import React from 'react';
import './SideBar.css';
import logo from './logo.svg';
import homeIcon from './home_icon.svg';
import learningIcon from './learning_icon.svg';
import challengesIcon from './challenges_icon.svg';
import leaderboardIcon from './leaderboard_icon.svg';
import settingsIcon from './settings_icon.svg';

const SideBar = () => {
    return (
        <div className="sidebar">
            <img src={logo} alt="Logo" className="sidebar-logo" />
            <a href="/home" className="sidebar-item">
                <img src={homeIcon} alt="Home" className="sidebar-item-icon" />
                <span className="sidebar-item-text">Home</span>
            </a>
            <a href="/learning" className="sidebar-item">
                <img src={learningIcon} alt="Learning" className="sidebar-item-icon" />
                <span className="sidebar-item-text">Learning</span>
            </a>
            <a href="/challenges" className="sidebar-item">
                <img src={challengesIcon} alt="Challenges" className="sidebar-item-icon" />
                <span className="sidebar-item-text">Challenges</span>
            </a>
            <a href="/leaderboard" className="sidebar-item">
                <img src={leaderboardIcon} alt="Leaderboard" className="sidebar-item-icon" />
                <span className="sidebar-item-text">Leaderboard</span>
            </a>
            <a href="/settings" className="sidebar-item">
                <img src={settingsIcon} alt="Settings" className="sidebar-item-icon" />
                <span className="sidebar-item-text">Settings</span>
            </a>

        </div>
    );
};

export default SideBar;