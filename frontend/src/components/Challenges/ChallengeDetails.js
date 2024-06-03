import React, { useState, useEffect } from 'react';
import { useNavigate, useParams, Link } from 'react-router-dom';
import { FaArrowLeft } from "react-icons/fa";
import axios from 'axios';
import './ChallengeDetails.css';

const ChallengeDetails = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [challengeDetails, setChallengeDetails] = useState(null);
    const [flag, setFlag] = useState('');
    const [errorMessage, setErrorMessage] = useState(null);
    const [machineMessage, setMachineMessage] = useState(null);
    const [machineLink, setMachineLink] = useState(null)
    const [timeout, setTimeout] = useState(null);

    //Get challenge details
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

    //Start machine
    const handleStartMachine = () => {
        const token = localStorage.getItem('Authorization');
        axios.post('https://localhost:8000/api/start_challenge', {
            challenge_id: id
        }, {
            headers: {
                "Content-Type": "multipart/form-data",
                "Authorization": `${token}`
            }
        })
            .then(response => {
                if (response.status === 200) {
                    setMachineMessage('Machine started successfully');
                    setMachineLink(response.data.challenge_path);
                    const timeoutValue = Number(response.data.timeout);
                    if (!isNaN(timeoutValue)) {
                        setTimeout(timeoutValue);
                    } else {
                        console.error('Invalid timeout value:', response.data.timeout);
                    }
                }
            })
            .catch(error => {
                if (error.response) {
                    setMachineMessage(error.response.data.status || 'Error starting machine');
                } else {
                    setMachineMessage('Error starting machine');
                }
            });
    }

    //Update timeout
    useEffect(() => {
        if (timeout > 0) {
            const timer = setInterval(() => {
                setTimeout(prevTimeout => prevTimeout - 1);
            }, 1000);
            return () => clearInterval(timer);
        }
    }, [timeout]);

    //Submit flag
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
                if (error.response.data.message == "Expired JWT Token") {
                    navigate('/login');
                }
            });
    }

    if (!challengeDetails) {
        return <div>Loading...</div>;
    }

    const navigateBack = () => {
        navigate('/challenges');
    }

    return (
        <div className="container">
            <div className="header">
                <Link to="/challenges">
                    < FaArrowLeft /> <span>challenges</span>
                </Link>
            </div>
            <div className="title-container">
                <h2>{challengeDetails.title}</h2>
            </div>

            <p><b>Points</b>: {challengeDetails.idReward.points}</p>
            <p><b>Difficulty</b>: {challengeDetails.idDifficulty.name}</p>
            <p><b>Completed</b>: {challengeDetails.isCompleted ? 'Yes' : 'No'}</p>

            <input className="input-field" type="text" placeholder="Enter flag" value={flag} onChange={e => setFlag(e.target.value)} />
            {errorMessage && <p>{errorMessage}</p>}
            <div className="button-container">
                <button onClick={handleStartMachine}>Start Machine</button>
                <button onClick={handleFlagSubmit}>Submit Flag</button>
            </div>

            {machineMessage && <p><b>Machine status:</b> {machineMessage}</p>}
            {timeout > 0 && <p className="running-time"><b>Running for: {Math.floor(timeout / 60)}:{timeout % 60 < 10 ? '0' : ''}{timeout % 60} (start again to extend time)</b></p>}
            {timeout === 0 && <p className="running-time"><b>Running for: Machine stopped</b></p>}
            {timeout > 0 && machineLink && <p className="machine-link"><b>Machine available here (may take up to few seconds to start):</b></p>}
            {timeout > 0 && machineLink && <p><a href={machineLink} target="_blank" rel="noopener noreferrer">{machineLink}</a></p>}
        </div>
    );
};

export default ChallengeDetails;