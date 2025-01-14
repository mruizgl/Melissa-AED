import React, { createContext, useState, useContext, ReactNode } from 'react';

type MovieType = {
  id: number;
  titulo: string;
  direccion: string;
  actores: string;
  argumento: string;
  imagen: string;
};

type FavoritesContextType = {
  favorites: MovieType[];
  addFavorite: (movie: MovieType) => void;
  removeFavorite: (movieId: number) => void;
};

const FavoritesContext = createContext<FavoritesContextType | undefined>(undefined);

export const useFavorites = () => {
  const context = useContext(FavoritesContext);
  if (!context) {
    throw new Error('useFavorites must be used within a FavoritesProvider');
  }
  return context;
};

type FavoritesProviderProps = {
  children: ReactNode;
};

export const FavoritesProvider = ({ children }: FavoritesProviderProps) => {
  const [favorites, setFavorites] = useState<MovieType[]>([]);


  const addFavorite = (movie: MovieType) => {
    setFavorites((prevFavorites) => [...prevFavorites, movie]);
  };


  const removeFavorite = (movieId: number) => {
    setFavorites((prevFavorites) => prevFavorites.filter((movie) => movie.id !== movieId));
  };

  return (
    <FavoritesContext.Provider value={{ favorites, addFavorite, removeFavorite }}>
      {children}
    </FavoritesContext.Provider>
  );
};
