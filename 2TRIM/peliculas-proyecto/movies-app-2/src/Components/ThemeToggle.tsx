import React, { useState, useEffect } from 'react';
import { FaSun, FaMoon } from 'react-icons/fa';  

const ThemeToggle: React.FC = () => {
  const [isDarkMode, setIsDarkMode] = useState(false);

  // Guardar la preferencia del usuario en el localStorage
  useEffect(() => {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
      setIsDarkMode(savedTheme === 'dark');
    }
  }, []);

  // Cambiar tema
  const toggleTheme = () => {
    setIsDarkMode((prevMode) => {
      const newMode = !prevMode;
      // Guardar la preferencia en localStorage
      localStorage.setItem('theme', newMode ? 'dark' : 'light');
      return newMode;
    });
  };

  // Aplicar la clase correspondiente al body
  useEffect(() => {
    if (isDarkMode) {
      document.body.classList.add('night');
      document.body.classList.remove('day');
    } else {
      document.body.classList.add('day');
      document.body.classList.remove('night');
    }
  }, [isDarkMode]);

  return (
    <button
      className="theme-toggle-btn"
      onClick={toggleTheme}
      aria-label="Toggle theme"
    >
      {isDarkMode ? <FaMoon /> : <FaSun />} 
    </button>
  );
};

export default ThemeToggle;
