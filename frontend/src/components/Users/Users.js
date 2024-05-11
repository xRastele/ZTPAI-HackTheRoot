import React, { useEffect, useState } from 'react';

function Users() {
    const [users, setUsers] = useState([]);

    useEffect(() => {
        const token = localStorage.getItem('Authorization');

        fetch('https://localhost:8000/api/users/', {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/ld+json",
                "Authorization": token
            }
        })
            .then(response => response.json())
            .then(data => setUsers(data['hydra:member']));
    }, []);

    if (!users) {
        return <div>Loading...</div>;
    }

    return (
        <div>
            {users.map(user => (
                <div key={user.id}>
                    <h1>{user.username}</h1>
                    <p>{user.email}</p>
                </div>
            ))}
        </div>
    );
}

export default Users;