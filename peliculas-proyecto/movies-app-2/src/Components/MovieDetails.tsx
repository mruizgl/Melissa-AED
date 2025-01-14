import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useFavorites } from '../Components/FavoritesContext';

type MovieType = {
  id: number;
  titulo: string;
  direccion: string;
  actores: string;
  argumento: string;
  imagen: string;
};

const MovieDetails = () => {
  const { id } = useParams<{ id: string }>();
  const navigate = useNavigate(); 
  const [movie, setMovie] = useState<MovieType | null>(null);
  const [isEditing, setIsEditing] = useState(false);
  const [formData, setFormData] = useState<MovieType | null>(null);
  const { favorites, addFavorite, removeFavorite } = useFavorites();
    const isFavorite = movie ? favorites.some((fav) => fav.id === movie.id) : false;
  useEffect(() => {
    const fetchMovie = async () => {

      try {
        const response = await fetch(`http://localhost:3001/peliculas/${id}`);
        const data = await response.json();
        setMovie(data);
        setFormData(data); 
      } catch (error) {
        console.error('Error fetching movie:', error);
      }
    };

    


    if (id) {
      fetchMovie();
    }
  }, [id]);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (formData) {
      setFormData({
        ...formData,
        [e.target.name]: e.target.value,
      });
    }
  };

  const handleSave = async () => {
    if (formData) {
      try {
        const response = await fetch(`http://localhost:3001/peliculas/${id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(formData),
        });
        const updatedMovie = await response.json();
        setMovie(updatedMovie);
        setIsEditing(false);
      } catch (error) {
        console.error('Error saving movie:', error);
      }
    }
  };

  const handleAddFavorite = () => {
    if (movie) {
      addFavorite(movie); 
    }
  };

  const handleRemoveFavorite = () => {
    if (movie) {
      removeFavorite(movie.id); 
    }
  };

  const handleDelete = async () => {
    try {
      await fetch(`http://localhost:3001/peliculas/${id}`, {
        method: 'DELETE',
      });
      navigate('/'); 
    } catch (error) {
      console.error('Error deleting movie:', error);
    }
  };

 
  if (!movie) return <div>Cargando...</div>;

  return (
    <div>
      <h1>{movie.titulo}</h1>
      {isEditing ? (
        <div>
          <label>
            Título:
            <input
              type="text"
              name="titulo"
              value={formData ? formData.titulo : ''}
              onChange={handleChange}
            />
          </label>
          <br />
          <label>
            Dirección:
            <input
              type="text"
              name="direccion"
              value={formData ? formData.direccion : ''}
              onChange={handleChange}
            />
          </label>
          <br />
          <label>
            Actores:
            <input
              type="text"
              name="actores"
              value={formData ? formData.actores : ''}
              onChange={handleChange}
            />
          </label>
          <br />
          <label>
            Argumento:
            <input
              type="text"
              name="argumento"
              value={formData ? formData.argumento : ''}
              onChange={handleChange}
            />
          </label>
          <br />
          <button onClick={handleSave}>Guardar</button>
        </div>
      ) : (
        <div>
          <p><strong>Dirección:</strong> {movie.direccion}</p>
          <p><strong>Actores:</strong> {movie.actores}</p>
          <p><strong>Argumento:</strong> {movie.argumento}</p>
        </div>
      )}
      <img src={`http://localhost:3001/${movie.imagen}`} alt={movie.titulo} />
      <div>
        <button onClick={() => setIsEditing(!isEditing)}>
          {isEditing ? 'Cancelar' : 'Editar'}
        </button>
        <button onClick={handleDelete}>Eliminar</button>
      </div>
      <div>
        {isFavorite ? (
            <button onClick={handleRemoveFavorite}>Eliminar de favoritos</button>
        ) : (
            <button onClick={handleAddFavorite}>Añadir a favoritos</button>
        )}
      </div>
    </div>
  );
};

export default MovieDetails;
