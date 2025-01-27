import React, { useState } from 'react';
import '../Css/CreateMovie.css';

const CreateMovie = () => {
  const [movie, setMovie] = useState({
    id: 1,
    titulo: '',
    direccion: '',
    actores: '',
    argumento: '',
    imagen: 'default.jpg',
  });

  const [lastId, setLastId] = useState(1);
  const [successMessage, setSuccessMessage] = useState('');
  const [errorMessage, setErrorMessage] = useState('');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    const { name, value } = e.target;
    
    setMovie({
      ...movie,
      [name]: value,
    });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    const newMovie = { ...movie, id: lastId + 1 };

    try {
      const response = await fetch('http://localhost:3001/peliculas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(newMovie),
      });

      if (response.ok) {
        setSuccessMessage('Película creada con éxito!');
        setErrorMessage('');
        setLastId(lastId + 1);
        
        setMovie({
          id: lastId + 2,
          titulo: '',
          direccion: '',
          actores: '',
          argumento: '',
          imagen: '/img/default.jpg',
        });
      } else {
        throw new Error('Hubo un error al crear la película.');
      }
    } catch (error) {
      setSuccessMessage('');
      setErrorMessage('Error al crear la película. Inténtalo de nuevo.');
    }
  };

  return (
    <div className="create-movie-container">
      <h2>Crear Nueva Película</h2>
      <form onSubmit={handleSubmit} className="create-movie-form">
        <input
          type="text"
          name="titulo"
          value={movie.titulo}
          onChange={handleChange}
          placeholder="Título de la película"
          className="create-movie-input"
          required
        />
        <input
          type="text"
          name="direccion"
          value={movie.direccion}
          onChange={handleChange}
          placeholder="Dirección"
          className="create-movie-input"
          required
        />
        <input
          type="text"
          name="actores"
          value={movie.actores}
          onChange={handleChange}
          placeholder="Actores"
          className="create-movie-input"
          required
        />
        <textarea
          name="argumento"
          value={movie.argumento}
          onChange={handleChange}
          placeholder="Argumento de la película"
          className="create-movie-textarea"
          required
        />
        
        <button type="submit" className="create-movie-button">
          Crear Película
        </button>
      </form>
      
    </div>
  );
};

export default CreateMovie;
