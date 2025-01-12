import React, { useState } from 'react';
import { useMovies } from '../context/MovieContext';
import { useNavigate } from 'react-router-dom';
import { Movie } from '../Models/Movie';

const CrearPelicula: React.FC = () => {
  const { addMovie } = useMovies();
  const navigate = useNavigate();
  const [movie, setMovie] = useState({ titulo: '', argumento: '', direccion: '', imagen: '', actores: '' });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setMovie((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const newMovie = new Movie(
      Date.now().toString(), 
      movie.titulo, 
      movie.direccion, 
      movie.actores, 
      movie.argumento, 
      movie.imagen 
    );
    addMovie(newMovie); 
    navigate('/');
  };

  return (
    <div>
      <h1>Crear Película</h1>
      <form onSubmit={handleSubmit}>
        <label>
          Título:
          <input name="titulo" value={movie.titulo} onChange={handleChange} required />
        </label>
        <label>
          Descripción:
          <textarea name="argumento" value={movie.argumento} onChange={handleChange} required />
        </label>
        <label>
          Categoría:
          <input name="direccion" value={movie.direccion} onChange={handleChange} required />
        </label>
        <label>
          Actores:
          <input name="actores" value={movie.actores} onChange={handleChange} required />
        </label>
        <label>
          Trailer (URL):
          <input name="imagen" value={movie.imagen} onChange={handleChange} />
        </label>
        <button type="submit">Crear</button>
      </form>
    </div>
  );
};

export default CrearPelicula;
