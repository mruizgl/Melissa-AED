package es.iespuerto.instituto.controller;

import java.util.List;
import java.util.stream.Collectors;

import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.service.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
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
@RequestMapping("/instituto/api/v2/usuarios")
public class UsuarioRESTControllerV2 {

    @Autowired
    private UsuarioService usuarioService;
    
    
    @GetMapping
    public List<Usuario> listarUsuarios() {
		Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
		String nombreAutenticado = ((UserDetails)principal).getUsername();
		
        List<Usuario> all = usuarioService.findAll();
        return all.stream()
        	.filter(u-> u.getNombre().equals(nombreAutenticado) )
        	.collect(Collectors.toList());
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