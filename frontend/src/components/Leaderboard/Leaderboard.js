import React from 'react';
import './Leaderboard.css';

const Leaderboard = () => {
    return (
        <div className="leaderboard-page">
            <div className="table-header">
                <p>Rank</p>
                <p>User</p>
                <p>Score</p>
            </div>
            <div className="leaderboard-row">
                <p>1</p>
                <p>user1</p>
                <p>1000</p>
            </div>
            <div className="leaderboard-row">
                <p>2</p>
                <p>user2</p>
                <p>900</p>
            </div>
            <div className="leaderboard-row">
                <p>3</p>
                <p>user3</p>
                <p>800</p>
            </div>
        </div>
    );
};

export default Leaderboard;