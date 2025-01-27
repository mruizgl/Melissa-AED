import React from 'react';
import '../Css/Navbar.css';  
import ThemeToggle from './ThemeToggle';
import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav className="navbar">
      <div className="navbar-brand">PeliApp by Melissa</div>
      <ul className="navbar-links">
        <li className="navbar-item"><Link to="/">Inicio</Link></li>
        <li className="navbar-item"><Link to="/search">Buscar película</Link></li>
        <li className="navbar-item"><Link to="/create">Crear película</Link></li>
        <li className="navbar-item"><Link to="/favorites">Ver favoritos</Link></li>
        <div className="navbar-right">
          <ThemeToggle /> 

        </div>
      </ul>
    </nav>
  );
};

export default Navbar;