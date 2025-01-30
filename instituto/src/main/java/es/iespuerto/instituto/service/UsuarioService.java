package es.iespuerto.instituto.service;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.repository.IUsuarioRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class UsuarioService implements IServiceGeneric<Usuario, String>{
    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    @Autowired
    IUsuarioRepository repository;

    @Override
    public List<Usuario> findAll() {
        List<Usuario> usuarios = repository.findAll();
        if (usuarios.isEmpty()) {
            logger.info("No se encontraron usuarios.");
        }
        return usuarios;
    }

    @Override
    public Usuario findById(String id) {
        Usuario usuario = repository.findById(id).orElse(null);
        if (usuario == null) {
            logger.info("Usuario no encontrado con id: " + id);
        }
        return usuario;
    }

    @Override
    public Usuario save(Usuario usuario) {
        Usuario savedUsuario = repository.save(usuario);
        return savedUsuario;
    }

    @Override
    public boolean delete(String id) {
        Optional<Usuario> usuario = repository.findById(id);
        if (usuario.isPresent()) {
            repository.deleteById(id);
            return true;
        }
        return false;
    }

    @Override
    public boolean update(Usuario usuario) {
        if (usuario != null) {
            Usuario existingUsuario = repository.findUsuarioByDNI(usuario.getDni());
            if (existingUsuario != null) {
                existingUsuario.setCorreo(usuario.getCorreo());
                existingUsuario.setNombre(usuario.getNombre());
                existingUsuario.setPassword(usuario.getPassword());

                repository.save(existingUsuario);
                return true;
            }
        }
        return false;
    }
}
