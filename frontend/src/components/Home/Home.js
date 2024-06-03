import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Home.css';
import commandInjectionIcon from '../../assets/command_injection.svg';
import deserializeMeIcon from '../../assets/deserializeme.svg';

const Home = () => {
    const [data, setData] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const token = localStorage.getItem('Authorization');
        axios.get('https://localhost:8000/api/home', {
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

    const handleChallengeClick = (id) => {
        navigate(`/challenges/${id}`);
    };

    return (
        <div className="home-page">
            <div className="row">
                <div className="card">
                    <p>{data.completedChallengesCount} challenges completed</p>
                    <h2>Rank: {data.rank}</h2>
                    <div className="progress-bar">
                        <div className="progress" style={{width: `${((data.points / data.rankMaxPoints) * 100).toFixed(2)}%`}}></div>
                    </div>
                    <p>{data.points}/{data.rankMaxPoints} pts</p>
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
                    {data.learningPaths.map((path, index) => (
                        <div className="small-card" key={index}>
                            <h3>{path.title}</h3>
                            <p>{path.description}</p>
                        </div>
                    ))}
                    <div className="arrow invisible">{'>'}</div>
                </div>
            </div>

            <div className="row">
                {data.challenges && data.challenges.map((challenge) => (
                    <div className="transparent-card" key={challenge.id} onClick={() => handleChallengeClick(challenge.id)}>
                        <img src={commandInjectionIcon} alt="Command Injection Icon" />
                        <h3>{challenge.title}</h3>
                        <p className="status recommended">Random challenge</p>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Home;