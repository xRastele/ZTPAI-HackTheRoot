import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Challenges.css';

const Challenges = () => {
    const [challenges, setChallenges] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const fetchChallenges = async () => {
            try {
                const token = localStorage.getItem('Authorization');
                if (!token) {
                    throw new Error('Authorization token not found');
                }
                const config = {
                    headers: {
                        "Authorization": `${token}`
                    }
                };
                const response = await axios.get('https://localhost:8000/api/challenges', config);
                setChallenges(response.data['hydra:member']);
                setLoading(false);
            } catch (err) {
                setError(err.message);
                setLoading(false);
                navigate('/login');
            }
        };

        fetchChallenges();
    }, []);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <div className="challenges-page">
            <div className="button-row">
                <button className="challenge-button active">All challenges</button>
                <button className="challenge-button">Not completed</button>
                <button className="challenge-button">Completed</button>
            </div>
            <div className="table-header">
                <p>Challenge</p>
                <p>Difficulty</p>
                <p>Reward</p>
            </div>
            {challenges.map((challenge) => (
                <div className="challenge-row" key={challenge.id}>
                    <p>{challenge.title}</p>
                    <p>{challenge.idDifficulty.name}</p>
                    <p>{challenge.idReward.points}</p>
                </div>
            ))}
        </div>
    );
};

export default Challenges;
