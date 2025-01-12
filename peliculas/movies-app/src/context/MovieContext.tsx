
import React, { createContext, useState, ReactNode, useContext, useEffect } from 'react';
import { Movie } from '../Models/Movie';

interface MoviesContextProps {
  movies: Movie[];
  favorites: Movie[];
  setMovies: React.Dispatch<React.SetStateAction<Movie[]>>;
  addMovie: (movie: Movie) => void;
  updateMovie: (id: string, updatedMovie: Movie) => void;
  deleteMovie: (id: string) => void;
  addFavorite: (movie: Movie) => void;
  removeFavorite: (id: string) => void;
}

export const MoviesContext = createContext<MoviesContextProps | undefined>(undefined);

export const useMovies = (): MoviesContextProps => {
  const context = useContext(MoviesContext);
  if (!context) {
    throw new Error('useMovies must be used within a MoviesProvider');
  }
  return context;
};

export const MoviesProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const [movies, setMovies] = useState<Movie[]>([]);
  const [favorites, setFavorites] = useState<Movie[]>([]);

  
  useEffect(() => {
    const storedMovies = localStorage.getItem('movies');
    const storedFavorites = localStorage.getItem('favorites');
    if (storedMovies) setMovies(JSON.parse(storedMovies));
    if (storedFavorites) setFavorites(JSON.parse(storedFavorites));
  }, []);


  useEffect(() => {
    localStorage.setItem('movies', JSON.stringify(movies));
    localStorage.setItem('favorites', JSON.stringify(favorites));
  }, [movies, favorites]);

  const addMovie = (movie: Movie) => {
    setMovies((prevMovies) => [...prevMovies, movie]);
  };

  const updateMovie = (id: string, updatedMovie: Movie) => {
    setMovies((prevMovies) =>
      prevMovies.map((movie) => (movie.id === id ? updatedMovie : movie))
    );
  };

  const deleteMovie = (id: string) => {
    setMovies((prevMovies) => prevMovies.filter((movie) => movie.id !== id));
    setFavorites((prevFavorites) => prevFavorites.filter((fav) => fav.id !== id));
  };

  const addFavorite = (movie: Movie) => {
    if (!favorites.some((fav) => fav.id === movie.id)) {
      setFavorites([...favorites, movie]);
    }
  };

  const removeFavorite = (id: string) => {
    setFavorites((prevFavorites) => prevFavorites.filter((fav) => fav.id !== id));
  };

  return (
    <MoviesContext.Provider
      value={{
        movies,
        favorites,
        setMovies,
        addMovie,
        updateMovie,
        deleteMovie,
        addFavorite,
        removeFavorite,
      }}
    >
      {children}
    </MoviesContext.Provider>
  );
};
