import React from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import './styles/App.css';
import SideBar from './components/SideBar/SideBar';
import TopBar from './components/TopBar/TopBar';
import Users from './components/Users/Users';
import Home from './components/Home/Home';
import Challenges from './components/Challenges/Challenges';
import Leaderboard from './components/Leaderboard/Leaderboard';
import Login from './components/Login/Login';
import Register from './components/Register/Register';

const MainContent = () => {
    const location = useLocation();
    const hideForAuthPages = location.pathname === '/login' || location.pathname === '/register';

    return (
        <div style={{ display: 'flex' }}>
            {!hideForAuthPages && <SideBar />}
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
                {!hideForAuthPages && <TopBar />}

                    <Routes>
                        <Route path="/" element={<Home />} />
                        <Route path="/users" element={<Users />} />
                        <Route path="/challenges" element={<Challenges />} />
                        <Route path="/leaderboard" element={<Leaderboard />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/register" element={<Register />} />
                    </Routes>

            </div>
        </div>
    );
};

const App = () => {
    return (
        <Router>
            <MainContent />
        </Router>
    );
};

export default App;