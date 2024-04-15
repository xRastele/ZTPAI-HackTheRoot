import React from 'react';
import './Challenges.css';

const Challenges = () => {
    return (
        <div className="challenges-page">
            <div className="button-row">
                <button className="challenge-button active">All challenges</button>
                <button className="challenge-button">Not completed</button>
                <button className="challenge-button">Completed</button>
            </div>
            <hr />
            <div className="table-header">
                <p>Challenge</p>
                <p>Difficulty</p>
                <p>Solved by</p>
                <p>Category</p>
            </div>
            <div className="challenge-row">
                <p>DeserializeMe!</p>
                <p>Easy</p>
                <p>127</p>
                <p>Other</p>
            </div>
            <div className="challenge-row">
                <p>Injection 1</p>
                <p>Easy</p>
                <p>255</p>
                <p>SQL Injection</p>
            </div>
            <div className="challenge-row">
                <p>Injection 2</p>
                <p>Medium</p>
                <p>88</p>
                <p>SQL Injection</p>
            </div>
        </div>
    );
};

export default Challenges;