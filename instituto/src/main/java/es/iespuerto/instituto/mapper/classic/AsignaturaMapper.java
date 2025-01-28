package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;

import java.util.List;
import java.util.stream.Collectors;

public class AsignaturaMapper {
    public static AsignaturaDTO toDTO(Asignatura asignatura) {
        return new AsignaturaDTO(
                asignatura.getId(),
                asignatura.getCurso(),
                asignatura.getNombre()
        );
    }

    public static List<AsignaturaDTO> toDTOList(List<Asignatura> asignaturas) {
        return asignaturas.stream()
                .map(AsignaturaMapper::toDTO)
                .collect(Collectors.toList());
    }

}
