package es.iespuerto.instituto.repository;

import es.iespuerto.instituto.entities.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.Optional;

/**
 * Repositorio de usuarios
 */
@Repository
public interface IUsuarioRepository extends JpaRepository<Usuario, Integer> {
    @Query("SELECT u FROM Usuario u WHERE u.nombre = :nombre")
    Optional<Usuario> findByNombre(@Param("nombre") String nombre);

    @Modifying
    @Query(
            value="DELETE FROM usuarios WHERE dni=:dni",
            nativeQuery=true
    )
    int deleteUsuarioByDNI(@Param("dni") String dni);

    @Modifying
    @Query(
            value="SELECT FROM usuarios WHERE dni=:dni",
            nativeQuery=true
    )
    int findUsuarioByDNI(@Param("dni") String dni);
}
