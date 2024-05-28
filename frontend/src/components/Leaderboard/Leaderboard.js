import './Leaderboard.css';
import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Leaderboard = () => {
    const [users, setUsers] = useState([]);

    useEffect(() => {
        const token = localStorage.getItem('Authorization');

        axios.get('https://localhost:8000/api/leaderboard', {
            headers: {
                "Authorization": token
            }
        })
            .then(response => {
                setUsers(response.data);
            })
            .catch(error => {
                console.error('There was an error!', error);
            });
    }, []);

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