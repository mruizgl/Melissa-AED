package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.mapper.classic.MatriculaMapper;
import es.iespuerto.instituto.mapper.classic.UsuarioMapper;
import es.iespuerto.instituto.service.MatriculaService;
import es.iespuerto.instituto.service.UsuarioService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;

/**
 * Controlador para api REST instituto de usuarios
 */
@RestController
@RequestMapping("/instituto/api/v1/usuarios")
@CrossOrigin
public class UsuarioRESTController {

    private static final Logger logger = LoggerFactory.getLogger(MatriculaRESTController.class);

    private final UsuarioService usuarioService;

    @Autowired
    public UsuarioRESTController (UsuarioService usuarioService) {
        this.usuarioService = usuarioService;
    }

    @GetMapping
    public ResponseEntity<List<UsuarioDTO>> findAllUsuarios() {
        List<UsuarioDTO> usuarios = UsuarioMapper.toDTOList(usuarioService.findAll());

        if (usuarios.isEmpty()) {
            logger.info("No se encontraron usuarios.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron {} usuarios.", usuarios.size());
        return ResponseEntity.ok(usuarios);
    }
}
