import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

function Home() {

  const [name, setName] = useState('');

  useEffect(() => {

    axios.get("/api/teste.json").then(res => {
      console.log(res);
      setName(res.data.nome);
    }).catch(err => {
      console.log(err);
    });

    axios.post("/api/cria-arquivo", {
      name: "Pedrinho",
      content: "mano"
    }).then(() => {
      console.log("Deu certo");
    }).catch(err => {
      console.log(err);
    });

  }, []);

  return (
    <div>
      Olá {name} <br />
      <Link to="/sobre">About</Link>
    </div>
  );
}

export default Home;