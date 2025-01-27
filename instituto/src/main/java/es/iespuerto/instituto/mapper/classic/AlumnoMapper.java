package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.entities.Matricula;

import java.util.stream.Collectors;

public class AlumnoMapper {
    public static AlumnoDTO toAlumnoDTO(Alumno alumno) {
        if (alumno == null) return null;

        return new AlumnoDTO(
                alumno.getDni(),
                alumno.getNombre(),
                alumno.getApellidos(),
                alumno.getFechanacimiento().getTime(),
                alumno.getImagen(),
                alumno.getMatriculas() != null ? alumno.getMatriculas().stream()
                        .map(AlumnoMapper::toMatriculaDTO)
                        .collect(Collectors.toList()) : null
        );
    }

    public static MatriculaDTO toMatriculaDTO(Matricula matricula) {
        if (matricula == null) return null;

        return new MatriculaDTO(
                matricula.getId(),
                matricula.getYear(),
                toAlumnoDTO(matricula.getAlumno()),
                matricula.getAsignaturas() != null ? matricula.getAsignaturas().stream()
                        .map(AsignaturaMapper::toAsignaturaDTO)
                        .collect(Collectors.toList()) : null
        );
    }
}
