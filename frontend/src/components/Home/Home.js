import React from 'react';
import './Home.css';
import commandInjectionIcon from '../../assets/command_injection.svg';
import deserializeMeIcon from '../../assets/deserializeme.svg';
const Home = () => {
    return (
        <div className="home-page">
            <div className="row">
                <div className="card">
                    <p>5 challenges completed</p>
                    <h2>Rank: Script kiddie</h2>
                    <div className="progress-bar">
                        <div className="progress" style={{width: '10%'}}></div>
                    </div>
                    <p>100/1000 pts</p>
                </div>
                <div className="card">
                    <p>Get access to paid challenges</p>
                    <h3>Refer a friend</h3>
                    <button>Send invite</button>
                </div>
            </div>

            <h2 className="centered-title">Recommended learning paths</h2>
            <div className="row">
                <div className="large-card">
                    <div className="arrow invisible">{'<'}</div>
                    <div className="small-card">
                        <h3>Title 1</h3>
                        <p>Description 1</p>
                    </div>
                    <div className="small-card">
                        <h3>Title 2</h3>
                        <p>Description 2</p>
                    </div>
                    <div className="arrow">{'>'}</div>
                </div>
            </div>

            <div className="row">
                <div className="transparent-card">
                    <img src={commandInjectionIcon} alt="Command Injection Icon" />
                    <h3>Title 1</h3>
                    <p className="status recommended">In progress</p>
                </div>
                <div className="transparent-card">
                    <img src={deserializeMeIcon} alt="Deserialize Me Icon" />
                    <h3>Title 2</h3>
                    <p className="status recommended">Recommended</p>
                    <p className="status recommended">challenge</p>
                </div>
            </div>
        </div>
    );
};

export default Home;