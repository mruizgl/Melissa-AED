import React, { useState, useEffect } from 'react';
import '../Css/Home.css';
import '../Css/Search.css';

type Props = {};

type MovieType = {
  id: number;
  titulo: string;
  argumento: string;
  imagen: string;
};

const url = `http://localhost:8000/api/peliculas`;

const getMoviesFromApi = async (): Promise<MovieType[]> => {
  const response = await fetch(`${url}peliculas`);
  return response.json();
};

const Home = (props: Props) => {
  const [movies, setMovies] = useState<MovieType[]>([]);
  const [search, setSearch] = useState('');
  const [typeSearch, setTypeSearch] = useState<keyof MovieType>('titulo'); 

  useEffect(() => {
    const fetchMovies = async () => {
      const fetchedMovies = await getMoviesFromApi();
      setMovies(fetchedMovies);
    };

    fetchMovies();
  }, []); 

  const filteredMovies = movies.filter((movie) => 
    String(movie[typeSearch])?.toLowerCase().includes(search.toLowerCase())
  );

  return (
    <div className="container">
      <h1>Películas</h1>

      <div className="search-bar">
        <input
          type="text"
          placeholder="Buscar película..."
          className="search-input"
          value={search}
          onChange={(e) => setSearch(e.target.value)}
        />

        <select
          className="search-select"
          value={typeSearch}
          onChange={(e) => setTypeSearch(e.target.value as keyof MovieType)} 
        >
          <option value="titulo">Título</option>
          <option value="argumento">Argumento</option>
        </select>
      </div>

      <div className="movies-grid">
        {filteredMovies.length > 0 ? (
          filteredMovies.map((movie) => (
            <div key={movie.id} className="movie-card">
              <img
                src={`img/${movie.imagen}`} 
                alt={movie.titulo}
                className="movie-img"
              />
              <div className="movie-info">
                <h2>{movie.titulo}</h2>
                <p><strong>Argumento:</strong> {movie.argumento}</p>
              </div>
            </div>
          ))
        ) : (
          <p>No se encontraron películas.</p>
        )}
      </div>
    </div>
  );
};

export default Home;
