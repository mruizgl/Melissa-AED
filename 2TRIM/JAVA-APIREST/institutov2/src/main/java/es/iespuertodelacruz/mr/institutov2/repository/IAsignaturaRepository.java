package es.iespuertodelacruz.mr.institutov2.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import es.iespuertodelacruz.mr.institutov2.entities.Asignatura;

@Repository
public interface IAsignaturaRepository extends JpaRepository<Asignatura, Integer>{

}
