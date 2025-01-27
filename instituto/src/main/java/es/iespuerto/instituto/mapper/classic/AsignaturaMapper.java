package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;

import java.util.stream.Collectors;

public class AsignaturaMapper {

    public static AsignaturaDTO toAsignaturaDTO(Asignatura asignatura) {
        if (asignatura == null) return null;

        return new AsignaturaDTO(
                asignatura.getId(),
                asignatura.getCurso(),
                asignatura.getNombre(),
                asignatura.getMatriculas() != null ? asignatura.getMatriculas().stream()
                        .map(MatriculaMapper::toMatriculaDTO)
                        .collect(Collectors.toList()) : null
        );
    }
}
