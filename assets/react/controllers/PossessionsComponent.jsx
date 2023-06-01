import React, { useEffect, useState } from "react";
import axios from "axios";

function possessionTable()
{
    const [data, setData] = useState([]);

    const possessionsData = () => {
        axios
            .get('/usersPossessions')
            .then(response => {
                console.log(response)
                setData(response.data)
            })
    }

    useEffect(() => {
        possessionsData();
    }, []);

    return <div className="container">
      <table className="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Valeur</th>
            <th scope="col">Type</th>
          </tr>
        </thead>
        <tbody>
          {data?.map(possession => ( 
            <tr key={possession.id}>
              <td>{possession.id}</td>
              <td>{possession.nom}</td>
              <td>{possession.valeur}</td>
              <td>{possession.type}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
}

export default possessionTable;