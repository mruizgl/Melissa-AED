package es.iespuerto.instituto.dto;

import java.util.List;

public record MatriculaDTO(
        int id,
        int year,
        List<AsignaturaDTO> asignaturas
) {}
