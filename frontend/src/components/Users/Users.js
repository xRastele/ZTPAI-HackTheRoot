import React, { useEffect, useState } from 'react';

function Users() {
    const [user, setUser] = useState(null);

    useEffect(() => {
        fetch('http://localhost:8000/api/users/')
            .then(response => response.json())
            .then(data => setUser(data));
    }, []);

    if (!user) {
        return <div></div>;
    }

    return (
        <div>
            <h1>{user.username}</h1>
            <p>{user.email}</p>
        </div>
    );
}

export default Users;