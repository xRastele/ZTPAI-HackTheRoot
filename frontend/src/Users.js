import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Users = () => {
    const [users, setUsers] = useState([]);

    useEffect(() => {
        axios.get('http://localhost:8000/users')
            .then(response => {
                setUsers(response.data);
            })
            .catch(error => {
                console.error(error);
            });
    }, []);

    return (
        <div>
            <h1>Users</h1>
            {users.map(user => (
                <div key={user.id}>
                    <h2>User ID: {user.id}</h2>
                    <p>Email: {user.email}</p>
                    <p>Username: {user.username}</p>
                    <p>Is Admin: {user.is_admin ? 'Yes' : 'No'}</p>
                </div>
            ))}
        </div>
    );
};

export default Users;