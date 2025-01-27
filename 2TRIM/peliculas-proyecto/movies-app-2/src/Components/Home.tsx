import React, { useState, useEffect } from 'react';
import '../Css/Home.css';
import { Link } from 'react-router-dom';

type Props = {};

type MovieType = {
    id: number;
    titulo: string;
    direccion: string;
    actores: string;
    argumento: string;
    imagen: string;
};

const url = `http://localhost:3001/`;


const getMoviesFromApi = async (): Promise<MovieType[]> => {
  const response = await fetch(`${url}peliculas`);
  return response.json();
};

const Home = (props: Props) => {
  const [movies, setMovies] = useState<MovieType[]>([]);

  useEffect(() => {
    const fetchMovies = async () => {
      const fetchedMovies = await getMoviesFromApi();
      setMovies(fetchedMovies);
    };

    fetchMovies();
  }, []); 

  return (
    <div className="container">
      <h1>Películas</h1>
      <div className="movies-grid">
        {movies.map((movie) => (
          <Link
          to={`/movie/${movie.id}`}
          key={movie.id}
          className="movie-card" 
        >
          <img src={url + movie.imagen} alt={movie.titulo} />
          <div className="movie-info">
            <h2>{movie.titulo}</h2>
            <p><strong>Dirección:</strong> {movie.direccion}</p>
            <p><strong>Actores:</strong> {movie.actores}</p>
            <p><strong>Argumento:</strong> {movie.argumento}</p>
          </div>
        </Link>
        ))}
      </div>
    </div>
  );
};


export default Home;
