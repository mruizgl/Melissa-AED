package es.iespuerto.instituto.dto;

import java.util.List;

public record AsignaturaDTO(
        int id,
        String curso,
        String nombre,
        List<MatriculaDTO> matriculas
) {}
