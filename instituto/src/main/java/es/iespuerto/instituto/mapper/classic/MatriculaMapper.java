package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Matricula;

import java.util.stream.Collectors;

import static es.iespuerto.instituto.mapper.classic.AlumnoMapper.toAlumnoDTO;

public class MatriculaMapper {

    public static MatriculaDTO toMatriculaDTO(Matricula matricula) {
        if (matricula == null) return null;

        return new MatriculaDTO(
                matricula.getId(),
                matricula.getYear(),
                toAlumnoDTO(matricula.getAlumno()), // Convierte Alumno a AlumnoDTO
                matricula.getAsignaturas() != null ? matricula.getAsignaturas().stream()
                        .map(AsignaturaMapper::toAsignaturaDTO)  // Convierte Asignatura a AsignaturaDTO
                        .collect(Collectors.toList()) : null
        );
    }
}
