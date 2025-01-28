package es.iespuerto.instituto.repository;

import es.iespuerto.instituto.entities.Usuario;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Modifying;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

/**
 * Repositorio de usuarios
 */
@Repository
public interface IUsuarioRepository extends JpaRepository<Usuario, Integer> {
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
    Usuario findUsuarioByDNI(@Param("dni") String dni);
}
