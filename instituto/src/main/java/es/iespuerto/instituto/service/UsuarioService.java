package es.iespuerto.instituto.service;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.repository.IMatriculaRepository;
import es.iespuerto.instituto.repository.IUsuarioRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

public class UsuarioService implements IServiceGeneric<Usuario, Integer>{
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
    public Usuario findById(Integer id) {
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
    public boolean delete(Integer id) {
        Optional<Usuario> usuario = repository.findById(id);
        if (usuario.isPresent()) {
            repository.deleteById(id);
            return true;
        }
        return false;
    }

    @Override
    public boolean update(Usuario usuario) {
        if (usuario != null ) {
            Usuario existingUsuario = repository.findById(usuario.getId()).orElse(null);
            if (existingUsuario != null) {
                existingUsuario.setEmail(usuario.getEmail());
                existingUsuario.setName(usuario.getName());
                existingUsuario.setPassword(usuario.getPassword());

                repository.save(existingUsuario);
                return true;
            }
        }
        return false;
    }
}
