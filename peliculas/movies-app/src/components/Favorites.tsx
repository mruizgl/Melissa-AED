import React, { useContext } from 'react';
import { MoviesContext } from '../context/MovieContext';
import { Link } from 'react-router-dom';

const Favorites: React.FC = () => {
  const moviesCtx = useContext(MoviesContext);

  if (!moviesCtx || moviesCtx.favorites.length === 0) return null;

  return (
    <div>
      <h3>Favoritos</h3>
      <ul>
        {moviesCtx.favorites.map((movie) => (
          <li key={movie.id}>
            <Link to={`/pelicula/${movie.id}`}>{movie.titulo}</Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Favorites;
