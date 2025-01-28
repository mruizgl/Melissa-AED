package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.service.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;

import java.util.List;
import java.util.stream.Collectors;

/**
 * Mapper de usuarios
 *
 * @author Melissa Ruiz
 */
public class UsuarioMapper {
    public static UsuarioDTO toDTO(Usuario usuario) {

        return new UsuarioDTO(
                usuario.getEmail(),
                usuario.getName(),
                usuario.getPassword()
        );
    }

    public static List<UsuarioDTO> toDTOList(List<Usuario> usuarios) {
        return usuarios.stream()
                .map(UsuarioMapper::toDTO)
                .collect(Collectors.toList());
    }

    public static List<Usuario> toUsuarios(List<UsuarioDTO> usuarioDTOS) {
        return usuarioDTOS.stream()
                .map(dto -> {
                    Usuario usuario = new Usuario();
                    usuario.setEmail(dto.email());
                    usuario.setName(dto.name());
                    usuario.setPassword(dto.password());
                    return usuario;
                })
                .collect(Collectors.toList());
    }
}
