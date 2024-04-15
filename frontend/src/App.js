import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import './styles/App.css';
import SideBar from './components/SideBar/SideBar';
import TopBar from './components/TopBar/TopBar';
import Users from './components/Users/Users';
import Home from './components/Home/Home';
import Challenges from './components/Challenges/Challenges';

const App = () => {
    return (
        <Router>
            <div style={{ display: 'flex' }}>
                <SideBar />
                <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
                    <TopBar />
                    <div style={{ flex: 1, padding: '10px' }}>
                        <Routes>
                            <Route path="/" element={<Home />} />
                            <Route path="/users" element={<Users />} />
                            <Route path="/challenges" element={<Challenges />} />
                        </Routes>
                    </div>
                </div>
            </div>
        </Router>
    );
};

export default App;