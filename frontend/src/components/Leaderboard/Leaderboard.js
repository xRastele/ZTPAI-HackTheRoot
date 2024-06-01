import './Leaderboard.css';
import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const Leaderboard = () => {
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const fetchLeaderboard = async () => {
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
                const response = await axios.get('https://localhost:8000/api/leaderboard', config);
                setUsers(response.data);
                setLoading(false);
            } catch (err) {
                setError(err.message);
                setLoading(false);
                navigate('/login');
            }
        };

        fetchLeaderboard();
    }, [navigate]);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;

    return (
        <div className="leaderboard-page">
            <div className="table-header">
                <p>Rank</p>
                <p>User</p>
                <p>Score</p>
            </div>
            {users.map((user, index) => (
                <div className="leaderboard-row" key={index}>
                    <p>{index + 1}</p>
                    <p>{user.username}</p>
                    <p>{user.points}</p>
                </div>
            ))}
        </div>
    );
};

export default Leaderboard;
