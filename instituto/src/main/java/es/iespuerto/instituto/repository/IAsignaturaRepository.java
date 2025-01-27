package es.iespuerto.instituto.repository;

import es.iespuerto.instituto.entities.Asignatura;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IAsignaturaRepository extends JpaRepository<Asignatura, Integer> {

}
