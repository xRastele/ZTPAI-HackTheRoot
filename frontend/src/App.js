// App.js
import React from 'react';
import './App.css';
import SideBar from './SideBar';
import TopBar from './TopBar';

const App = () => {
    return (
        <div style={{ display: 'flex' }}>
            <SideBar />
            <div style={{ flex: 1, display: 'flex', flexDirection: 'column' }}>
                <TopBar />
            </div>
        </div>
    );
};

export default App;