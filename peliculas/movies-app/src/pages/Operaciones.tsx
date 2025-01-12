
import React, { useState } from 'react';
import { useMovies } from '../context/MovieContext';
import { Link } from 'react-router-dom';

const Operaciones: React.FC = () => {
  const { movies } = useMovies();
  const [search, setSearch] = useState('');

  const filteredMovies = movies.filter((movie) =>
    movie.titulo.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div>
      <h1>Buscar Películas</h1>
      <input
        type="text"
        placeholder="Buscar por título"
        value={search}
        onChange={(e) => setSearch(e.target.value)}
      />
      <ul>
        {filteredMovies.map((movie) => (
          <li key={movie.id}>
            <Link to={`/pelicula/${movie.id}`}>{movie.titulo}</Link>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Operaciones;
