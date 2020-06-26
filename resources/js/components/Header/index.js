import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import { FiLogOut } from 'react-icons/fi';
import { FaLinkedin, FaFacebookSquare, FaInstagramSquare, FaTwitterSquare } from 'react-icons/fa';

import './styles.css';
import api from '../../services/api';
import logo from '../../assets/logo.png';

export default function Header() {
  const history = useHistory();

  function handleLogout() {

    const cookies = document.cookie;

    console.log(cookies);

      api.post('logout', cookies);



    // localStorage.clear();
    // history.push('/');
  }

  return (
    <header id="main-header">
      <div className="header-content">
        <span>
          <img src={logo} alt="LobbySys"/>
        </span>


        <div className="btnNavegacao">
          <Link className="button" to="/dashboard">
            <button className="btn">Dashboard</button>
          </Link>
          <Link className="button" to="/users">
            <button className="btn">Usuários</button>
          </Link>
          <Link className="button" to="/visitors">
            <button className="btn">Visitantes</button>
          </Link>
          <Link className="button" to="/rooms">
            <button className="btn">Salas</button>
          </Link>
          <Link className="button" to="/concierges">
            <button className="btn">Portaria</button>
          </Link>
        </div>


        <span>
          <a href="https://www.linkedin.com/in/alex-botelho-almeida/">
            <FaLinkedin size="28" />
          </a>
          <a href="https://www.facebook.com/alexbotelhoa">
            <FaFacebookSquare size="28" />
          </a>
          <a href="https://www.instagram.com/alexbotelhoa">
            <FaInstagramSquare size="28" />
          </a>
          <a href="https://www.instagram.com/alexbotelhoa">
            <FaTwitterSquare size="28" />
          </a>
          <button className="logout" type="button" onClick={() => handleLogout()}>
            <FiLogOut size="28" /> 
          </button>
        </span>
      </div>
    </header>
  )
}