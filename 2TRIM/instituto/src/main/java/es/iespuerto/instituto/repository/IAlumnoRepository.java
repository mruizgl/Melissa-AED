package es.iespuerto.instituto.repository;


import es.iespuerto.instituto.entities.Alumno;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

/**
 * Repositorio de alumnos
 */
@Repository
public interface IAlumnoRepository extends JpaRepository<Alumno, String> {
    @Modifying
    @Query(
            value="DELETE FROM alumnos WHERE dni=:dni",
            nativeQuery=true
    )
    int deleteAlumnoByDNI(@Param("dni") String dni);
}

