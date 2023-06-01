import React, { useEffect, useState } from "react";
import axios from "axios";

function userTable()
{
    const [data, setData] = useState([]);
    
    const usersData = () => {
        axios
            .get('/usersData')
            .then(response => {
                console.log(response)
                setData(response.data)
            })
            .catch(error => {
                console.error(error)
            })
    }

    useEffect(() => {
        usersData();
    }, []);

    function deleteUser(id) {
      axios
        .delete(`/usersData/${id}`)
        .then(response => {
          console.log(response)
          setData(data => data.filter(user => user.id !== id))
        })
        .catch(error => {
          console.error(error.response.data)
        })
    }

    return <div className="container">
      <table className="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Email</th>
            <th scope="col">Adresse</th>
            <th scope="col">Tél</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          {data?.map(user => ( 
            <tr key={user.id}>
              <td>{user.id}</td>
              <td><a href="">{user.nom}</a></td>
              <td>{user.prenom}</td>
              <td>{user.email}</td>
              <td>{user.adresse}</td>
              <td>{user.tel}</td>
              <td><button onClick={()=>deleteUser(user.id)} className="btn btn-danger">Supprimer</button></td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
}

export default userTable;