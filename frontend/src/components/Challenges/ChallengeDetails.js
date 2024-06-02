import React, { useState, useEffect } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import axios from 'axios';
import './ChallengeDetails.css';

const ChallengeDetails = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [challengeDetails, setChallengeDetails] = useState(null);
    const [flag, setFlag] = useState('');
    const [errorMessage, setErrorMessage] = useState(null);

    useEffect(() => {
        const token = localStorage.getItem('Authorization');
        axios.get(`https://localhost:8000/api/challenges/${id}`,{
            headers: {
                "Authorization": `${token}`
            }
        })
            .then(response => setChallengeDetails(response.data))
            .catch(error => {
                console.error(error);
                navigate('/login');
            });
    }, [id]);

    const handleFlagSubmit = () => {
        const token = localStorage.getItem('Authorization');
        axios.post('https://localhost:8000/api/challenge/answer', {
            id: challengeDetails.id,
            flag: flag
        }, {
            headers: {
                "Content-Type": "multipart/form-data",
                "Authorization": `${token}`
            }
        })
            .then(response => {
                if (response.status === 200) {
                    setErrorMessage('Flag submitted successfully');
                }
            })
            .catch(error => {
                if (error.response) {
                    setErrorMessage(error.response.data.message || 'Wrong flag provided');
                } else {
                    setErrorMessage('Error submitting flag');
                }
            });
    }

    if (!challengeDetails) {
        return <div>Loading...</div>;
    }

    return (
        <div className="container">
            <h2>{challengeDetails.title}</h2>
            <p><b>Points</b>: {challengeDetails.idReward.points}</p>
            <p><b>Difficulty</b>: {challengeDetails.idDifficulty.name}</p>
            <p><b>Completed</b>: {challengeDetails.isCompleted ? 'Yes' : 'No'}</p>
            <input className="input-field" type="text" placeholder="Enter flag" value={flag} onChange={e => setFlag(e.target.value)} />
            {errorMessage && <p>{errorMessage}</p>}
            <div className="button-container">
                <button>Start Machine</button>
                <button onClick={handleFlagSubmit}>Submit Flag</button>
            </div>
        </div>
    );
};

export default ChallengeDetails;