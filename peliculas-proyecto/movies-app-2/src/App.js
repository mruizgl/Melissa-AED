import React, { useEffect } from 'react';
import { Route, Routes } from 'react-router-dom';
import Navbar from './Components/Navbar'; 
import Home from './Components/Home'; 
import { ThemeProvider, useTheme } from './Components/ThemeContext'; 
import FindMovie from './Components/FindMovie';
import CreateMovie from './Components/CreateMovie';
import MovieDetails from './Components/MovieDetails';
import Favorites from './Components/Favorites';
import { FavoritesProvider } from './Components/FavoritesContext'; 

function App() {
  return (
    <ThemeProvider>
      <FavoritesProvider> 
        <Main />
      </FavoritesProvider>
    </ThemeProvider>
  );
}

const Main = () => {
  const { theme, toggleTheme } = useTheme();

  useEffect(() => {
    if (theme === 'night') {
      document.body.classList.add('night');
      document.body.classList.remove('day');
      localStorage.setItem('theme', 'night');
    } else {
      document.body.classList.add('day');
      document.body.classList.remove('night');
      localStorage.setItem('theme', 'day');
    }
  }, [theme]); 

  return (
    <div>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/search" element={<FindMovie />} />
        <Route path="/create" element={<CreateMovie />} />
        <Route path="/movie/:id" element={<MovieDetails />} />
        <Route path="/favorites" element={<Favorites />} />
      </Routes>
    </div>
  );
};

export default App;
