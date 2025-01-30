package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.DateToLongConverter;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.entities.Usuario;

import java.util.List;
import java.util.stream.Collectors;

public class UsuarioMapperClassic {

    public static UsuarioDTO toDTO(Usuario usuario) {

        return new UsuarioDTO(
                usuario.getDni(),
                usuario.getEmail(),
                DateToLongConverter.longToDate(usuario.getFechaCreacion()),
                usuario.getNombre(),
                usuario.getPassword(),
                usuario.getRol()

        );
    }

    public static Usuario toEntity(UsuarioDTO usuarioDTO) {

        return new Usuario(
                usuarioDTO.dni(),
                usuarioDTO.fechaCreacion().getTime(),
                usuarioDTO.correo(),
                usuarioDTO.nombre(),
                usuarioDTO.password(),
                usuarioDTO.rol()
        );
    }

    public static List<UsuarioDTO> toDTOList(List<Usuario> usuarios) {
        return usuarios.stream()
                .map(UsuarioMapperClassic::toDTO)
                .collect(Collectors.toList());
    }

    public static List<Usuario> toAsignaturas(List<UsuarioDTO> usuarioDTOS) {
        return usuarioDTOS.stream()
                .map(UsuarioMapperClassic::toEntity)
                .collect(Collectors.toList());
    }
}
