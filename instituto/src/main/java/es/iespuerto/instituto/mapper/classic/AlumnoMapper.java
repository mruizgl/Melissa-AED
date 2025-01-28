package es.iespuerto.instituto.mapper.classic;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;

import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;

public class AlumnoMapper {

    public static AlumnoDTO toDTO(Alumno alumno) {
        return new AlumnoDTO(
                alumno.getDni(),
                alumno.getNombre(),
                alumno.getApellidos(),
                alumno.getFechanacimiento(),
                alumno.getImagen(),
                toMatriculaDTOList(alumno.getMatriculas())
        );
    }

    public static List<AlumnoDTO> toDTOList(List<Alumno> alumnos) {
        return alumnos.stream()
                .map(AlumnoMapper::toDTO)
                .collect(Collectors.toList());
    }

    // Convierte una Matricula en MatriculaDTO
    public static MatriculaDTO toMatriculaDTO(Matricula matricula) {
        return new MatriculaDTO(
                matricula.getId(),
                matricula.getYear(),
                toAsignaturaDTOList(matricula.getAsignaturas())
        );
    }

    public static List<MatriculaDTO> toMatriculaDTOList(List<Matricula> matriculas) {
        return (matriculas == null) ? Collections.emptyList() : matriculas.stream()
                .map(AlumnoMapper::toMatriculaDTO)
                .collect(Collectors.toList());
    }

    public static AsignaturaDTO toAsignaturaDTO(Asignatura asignatura) {
        return new AsignaturaDTO(
                asignatura.getId(),
                asignatura.getCurso(),
                asignatura.getNombre()
        );
    }

    public static List<AsignaturaDTO> toAsignaturaDTOList(List<Asignatura> asignaturas) {
        return (asignaturas == null) ? Collections.emptyList() : asignaturas.stream()
                .map(AlumnoMapper::toAsignaturaDTO)
                .collect(Collectors.toList());
    }
}
