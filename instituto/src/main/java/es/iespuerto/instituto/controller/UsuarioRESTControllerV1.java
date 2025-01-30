package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.mapper.classic.UsuarioMapper;
import es.iespuerto.instituto.mapper.classic.UsuarioMapperClassic;
import es.iespuerto.instituto.service.UsuarioService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.UUID;

/**
 * Controlador para api REST instituto de usuarios
 *
 * @author Melissa Ruiz
 */
@RestController
@RequestMapping("/instituto/api/v1/usuarios")
@CrossOrigin
public class UsuarioRESTControllerV1 {

    private static final Logger logger = LoggerFactory.getLogger(MatriculaRESTController.class);

    private final UsuarioService usuarioService;

    @Autowired
    public UsuarioRESTControllerV1(UsuarioService usuarioService) {
        this.usuarioService = usuarioService;
    }

    @GetMapping
    //@PreAuthorize("hasRole('ROLE_ADMIN')")
    public ResponseEntity<?> listarUsuarios() {

        List<Usuario> findAll = usuarioService.findAll();

        List<UsuarioDTO> allDTO = UsuarioMapperClassic.toDTOList(findAll);
        logger.info("Se encontraron {} usuarios.", allDTO.size());
        return ResponseEntity.ok(allDTO);
    }

    @PostMapping
    public Usuario crearUsuario(@RequestBody UsuarioDTO dto) {
        Usuario u = new Usuario();
        u.setEmail(dto.correo());
        u.setFechaCreacion(dto.fechaCreacion().getTime());
        u.setNombre(dto.nombre());
        u.setPassword(dto.password());
        u.setRol("ROLE_USER");
        String tokenDeVerificacion = UUID.randomUUID().toString();
        u.setRememberToken(tokenDeVerificacion);
        logger.info("Usuario creado con dni: {}", u.getDni());
        return usuarioService.save(u);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminarUsuario(@PathVariable Integer id) {
        usuarioService.delete(id);
        logger.info("Usuario eliminado con dni: {}", id);
        return ResponseEntity.noContent().build();
    }

    @GetMapping("/test")
    public ResponseEntity<String> testEndpoint() {
        return ResponseEntity.ok("Test endpoint is working");
    }
}
