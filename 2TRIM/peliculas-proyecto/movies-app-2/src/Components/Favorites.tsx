import React from 'react';
import { useFavorites } from '../Components/FavoritesContext';
import { Link } from 'react-router-dom';

const Favorites = () => {
  const { favorites } = useFavorites();

  return (
    <div>
      <h1>Películas Favoritas</h1>
      <div className="movies-grid">
        {favorites.length === 0 ? (
          <p>No tienes películas favoritas aún.</p>
        ) : (
          favorites.map((movie) => (
            <Link key={movie.id} to={`/movie/${movie.id}`} className="movie-card">
              <img src={`http://localhost:3001/${movie.imagen}`} alt={movie.titulo} />
              <div className="movie-info">
                <h2>{movie.titulo}</h2>
                <p><strong>Dirección:</strong> {movie.direccion}</p>
                <p><strong>Actores:</strong> {movie.actores}</p>
              </div>
            </Link>
          ))
        )}
      </div>
    </div>
  );
};

export default Favorites;
