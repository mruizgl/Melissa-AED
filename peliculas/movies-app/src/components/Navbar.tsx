import React, { useContext } from 'react';
import { Link } from 'react-router-dom';
import { ThemeContext } from '../context/ThemeContext';

const Navbar: React.FC = () => {
  const themeCtx = useContext(ThemeContext);

  if (!themeCtx) {
    console.error('ThemeContext no está disponible.');
    return null; 
  }
  

  return (
    <nav style={{ padding: '1rem', backgroundColor: '#333', color: 'white' }}>
      <Link to="/" style={{ color: 'white', margin: '0 1rem' }}>Inicio</Link>
      <Link to="/crear" style={{ color: 'white', margin: '0 1rem' }}>Crear Película</Link>
      <Link to="/categorias" style={{ color: 'white', margin: '0 1rem' }}>Categorías</Link>
      <button
        onClick={themeCtx.toggleTheme}
        style={{ marginLeft: '1rem', padding: '0.5rem 1rem', backgroundColor: '#444', color: 'white', border: 'none', cursor: 'pointer' }}
      >
        Modo {themeCtx.theme === 'light' ? 'Oscuro' : 'Claro'}
      </button>
    </nav>
   
  );
};

export default Navbar;
