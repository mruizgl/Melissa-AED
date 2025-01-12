import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { MoviesProvider } from './context/MovieContext';
import { ThemeProvider } from './context/ThemeContext';
import Navbar from './Components/Navbar';
import Home from './pages/Home';
import Favorites from './Components/Favorites';
import CrearPelicula from 'pages/CrearPelicula';
import EditarBorrarMostrarPelicula from 'pages/EditarBorrarMostrarPelicula';

const App: React.FC = () => {
  return (
    <MoviesProvider>
      <ThemeProvider>
        <Router>
          <Navbar />
          <Favorites />
    
          <Routes>        
            <Route path="/" element={<Home />} />          
            <Route path="/crearpelicula" element={<CrearPelicula />} />
            <Route path="/pelicula/:id" element={<EditarBorrarMostrarPelicula />} />
          </Routes>
   
        </Router>
      </ThemeProvider>
    </MoviesProvider>
  );
};

export default App;
