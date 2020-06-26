import React from 'react';
import { RiBuilding3Line } from 'react-icons/ri';
import { Link, useHistory } from 'react-router-dom';
import { FiLogOut } from 'react-icons/fi';
import { FaLinkedin, FaFacebookSquare, FaInstagramSquare, FaTwitterSquare } from 'react-icons/fa';

import './styles.css';
import api from '../../services/api';
import logo from '../../assets/logo.png';

export default function Header() {
  const history = useHistory();

    /**
    * Se quiser construir o sistema de Login totalmente em Javascript
    * basta retirar essa função a baixo e criar o Controller
    */
  async function redirectLoginInLaravel(event) { 
    event.preventDefault();

    await api.get('logout');
  } 

  function deleteAllCookies(nome) {
    // const cookies = document.cookie.split(";");

    // for (var i = 0; i < cookies.length; i++) {
    //     var cookie = cookies[i];
    //     var eqPos = cookie.indexOf("=");
    //     var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    //     document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    // }

    // document.cookie = "lobbysis_session"; 
    // console.log(document.cookie); 

    // Cria uma nova data no futuro 01/01/2020

    var data = new Date(1)
    data = data.toGMTString();
    // document.cookie = 'lobbysis_session=; expires=' + data + '; path=/';
    document.cookie = nome + '=; expires=' + data + '; path=/';
    console.log(data)

  }

  function handleLogout() {
    localStorage.clear();
    history.push('/');
  }

  return (
    <header id="main-header">
      <div className="header-content">
        <span>
          <RiBuilding3Line size="32" className="imageLogo" />
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
          <button className="logout" type="button" onClick={() => deleteAllCookies('lobbysis_session')}>
            <FiLogOut size="28" /> 
          </button>
        </span>
      </div>
    </header>
  )
}