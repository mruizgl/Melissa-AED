
import React, { useState } from 'react';
import { useMovies } from '../context/MovieContext';

const Categorias: React.FC = () => {
  const { movies } = useMovies();
  const [categories, setCategories] = useState<string[]>(() => {
    const uniqueCategories = new Set(movies.map((movie) => movie.direccion));
    return Array.from(uniqueCategories);
  });
  const [newCategory, setNewCategory] = useState('');

  const handleAddCategory = () => {
    if (newCategory && !categories.includes(newCategory)) {
      setCategories((prev) => [...prev, newCategory]);
    }
    setNewCategory('');
  };

  return (
    <div>
      <h1>Categorías</h1>
      <ul>
        {categories.map((direccion) => (
          <li key={direccion}>
            <h3>{direccion}</h3>
            <ul>
              {movies
                .filter((movie) => movie.direccion === direccion)
                .map((movie) => (
                  <li key={movie.id}>{movie.titulo}</li>
                ))}
            </ul>
          </li>
        ))}
      </ul>
      <div>
        <input
          type="text"
          placeholder="Nueva categoría"
          value={newCategory}
          onChange={(e) => setNewCategory(e.target.value)}
        />
        <button onClick={handleAddCategory}>Crear Categoría</button>
      </div>
    </div>
  );
};

export default Categorias;
