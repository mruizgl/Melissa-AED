import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useMovies } from '../context/MovieContext';
import { Movie } from '../Models/Movie';

const EditarBorrarMostrarPelicula: React.FC = () => {
  const { id } = useParams<{ id: string }>();
  const { updateMovie, deleteMovie, addFavorite } = useMovies();
  const navigate = useNavigate();

  const [editableMovie, setEditableMovie] = useState<Movie | null>(null);

  // Fetch movie data
  useEffect(() => {
    if (!id) return;

    fetch(`http://localhost:3001/peliculas/${id}`)
      .then((res) => res.json())
      .then((data: Movie) => setEditableMovie(data))
      .catch((error) => console.error('Error al cargar la película:', error));
  }, [id]);

  if (!editableMovie) {
    return <p>Cargando película...</p>;
  }

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    setEditableMovie((prev) => {
      if (!prev) return null;
     
      return new Movie(
        prev.id,
        name === 'titulo' ? value : prev.titulo,
        name === 'direccion' ? value : prev.direccion,
        name === 'actores' ? value : prev.actores,
        name === 'argumento' ? value : prev.argumento,
        name === 'imagen' ? value : prev.imagen
      );
    });
  };
  

  const handleUpdate = () => {
    if (!id || !editableMovie) {
      alert('ID o datos de la película no válidos.');
      return;
    }

    const updatedMovie = new Movie(
      id,
      editableMovie.titulo,
      editableMovie.direccion,
      editableMovie.actores,
      editableMovie.argumento,
      editableMovie.imagen
    );

    updateMovie(id, updatedMovie); 
    navigate('/');
  };

  const handleDelete = () => {
    if (!id) {
      alert('ID no válido.');
      return;
    }
    deleteMovie(id);
    navigate('/');
  };

  const handleFavorite = () => {
    if (editableMovie) addFavorite(editableMovie);
  };

  return (
    <div>
      <h1>Editar Película</h1>
      <form>
        <label>
          Título:
          <input name="titulo" value={editableMovie.titulo} onChange={handleChange} />
        </label>
        <label>
          Descripción:
          <textarea name="argumento" value={editableMovie.argumento} onChange={handleChange} />
        </label>
        <label>
          Categoría:
          <input name="direccion" value={editableMovie.direccion} onChange={handleChange} />
        </label>
        <label>
          Trailer (URL):
          <input name="imagen" value={editableMovie.imagen} onChange={handleChange} />
        </label>
        <label>
          Actores:
          <input name="actores" value={editableMovie.actores} onChange={handleChange} />
        </label>
        <button type="button" onClick={handleUpdate}>Modificar</button>
        <button type="button" onClick={handleDelete}>Borrar</button>
        <button type="button" onClick={handleFavorite}>Marcar como Favorito</button>
      </form>
    </div>
  );
};

export default EditarBorrarMostrarPelicula;
