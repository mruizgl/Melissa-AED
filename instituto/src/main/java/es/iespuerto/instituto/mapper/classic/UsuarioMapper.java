package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Usuario;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.factory.Mappers;


import java.util.List;

/**
 * Mapper de usuarios
 *
 * @author Melissa Ruiz
 */
@Mapper
public interface UsuarioMapper {
    UsuarioMapper INSTANCE = Mappers.getMapper(UsuarioMapper.class);


    @Mapping(target = "fechaCreacion", expression = "java(usuario.getFechaCreacion() != null ? new java.util.Date(usuario.getFechaCreacion()) : null)")
    UsuarioDTO toDTO(Usuario usuario);


    @Mapping(target = "fechaCreacion", expression = "java(usuarioDTO.fechaCreacion() != null ? usuarioDTO.fechaCreacion().getTime() : null)")
    Usuario toEntity(UsuarioDTO usuarioDTO);


    List<UsuarioDTO> toDTOList(List<Usuario> usuarios);


    List<Usuario> toEntityList(List<UsuarioDTO> usuarioDTOs);
}