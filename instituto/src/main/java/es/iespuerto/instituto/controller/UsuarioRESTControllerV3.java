package es.iespuerto.instituto.controller;

import java.util.List;

import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.service.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;


@RestController
@CrossOrigin
@RequestMapping("/instituto/api/v3/usuarios")
public class UsuarioRESTControllerV3 {

    @Autowired
    private UsuarioService usuarioService;
    
    
    @GetMapping
    //@PreAuthorize("hasRole('ROLE_ADMIN')")
    public List<Usuario> listarUsuarios() {
        return usuarioService.findAll();
    }

    @PostMapping
    public Usuario crearUsuario(@RequestBody Usuario usuario) {
        return usuarioService.save(usuario);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<?> eliminarUsuario(@PathVariable Integer id) {
        usuarioService.delete(id);
        return ResponseEntity.noContent().build();
    }
}