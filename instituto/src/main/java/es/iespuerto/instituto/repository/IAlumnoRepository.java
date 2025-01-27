package es.iespuerto.instituto.repository;


import es.iespuerto.instituto.entities.Alumno;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;


@Repository
public interface IAlumnoRepository extends JpaRepository<Alumno, String> {

    @Modifying
    //@Query("DELETE FROM Alumno a WHERE a.dni=:dni")
    @Query(
            value="DELETE FROM alumnos AS a WHERE a.dni=:dni",
            nativeQuery=true
    )
    int deleteAlumnoByDNI(@Param("dni") String dni);
}

