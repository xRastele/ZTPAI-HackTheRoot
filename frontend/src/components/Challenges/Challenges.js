import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './Challenges.css';
import { FaCheck, FaMinus } from "react-icons/fa";

const Challenges = () => {
    const [challenges, setChallenges] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [filter, setFilter] = useState('all');
    const [selectedButton, setSelectedButton] = useState('all'); // New state for the selected button
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

    const handleChallengeClick = (id) => {
        navigate(`/challenges/${id}`);
    };

    const filteredChallenges = challenges.filter(challenge => {
        if (filter === 'all') return true;
        if (filter === 'completed') return challenge.isCompleted;
        if (filter === 'notCompleted') return !challenge.isCompleted;
    });

    return (
        <div className="challenges-page">
            <div className="button-row">
                <button className={`challenge-button ${selectedButton === 'all' ? 'active' : ''}`} onClick={() => {setFilter('all'); setSelectedButton('all');}}>All challenges</button>
                <button className={`challenge-button ${selectedButton === 'notCompleted' ? 'active' : ''}`} onClick={() => {setFilter('notCompleted'); setSelectedButton('notCompleted');}}>Not completed</button>
                <button className={`challenge-button ${selectedButton === 'completed' ? 'active' : ''}`} onClick={() => {setFilter('completed'); setSelectedButton('completed');}}>Completed</button>
            </div>
            <div className="table-header">
                <p>Challenge</p>
                <p>Difficulty</p>
                <p>Reward</p>
                <p>Completed</p>
            </div>
            {filteredChallenges.map((challenge) => (
                <div className="challenge-row" key={challenge.id} onClick={() => handleChallengeClick(challenge.id)}>
                    <p>{challenge.title}</p>
                    <p>{challenge.idDifficulty.name}</p>
                    <p>{challenge.idReward.points}</p>
                    <p>{challenge.isCompleted ? <FaCheck /> : <FaMinus />}</p>
                </div>
            ))}
        </div>
    );
};

export default Challenges;