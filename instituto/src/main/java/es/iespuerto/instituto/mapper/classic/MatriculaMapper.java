package es.iespuerto.instituto.mapper.classic;


import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;

import java.util.List;
import java.util.stream.Collectors;

/**
 * Mapper de matriculas
 *
 * @author Melissa Ruiz
 */
public class MatriculaMapper {

    public static MatriculaDTO toDTO(Matricula matricula) {
        List<AsignaturaDTO> asignaturasDTO = AsignaturaMapper.toDTOList(matricula.getAsignaturas());

        return new MatriculaDTO(
                matricula.getId(),
                matricula.getYear(),
                asignaturasDTO
        );
    }

    public static List<MatriculaDTO> toDTOList(List<Matricula> matriculas) {
        return matriculas.stream()
                .map(MatriculaMapper::toDTO)
                .collect(Collectors.toList());
    }

    public static List<Asignatura> toAsignaturas(List<AsignaturaDTO> asignaturasDTO) {
        return asignaturasDTO.stream()
                .map(dto -> {
                    Asignatura asignatura = new Asignatura();
                    asignatura.setId(dto.id());
                    asignatura.setCurso(dto.curso());
                    asignatura.setNombre(dto.nombre());
                    return asignatura;
                })
                .collect(Collectors.toList());
    }
}
