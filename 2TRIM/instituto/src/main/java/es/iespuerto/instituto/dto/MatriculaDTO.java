package es.iespuerto.instituto.dto;

import java.util.List;

/**
 * Manejo de atributos record de matriculas
 * @param id de matricula
 * @param year de matricula
 * @param asignaturas de matricula
 *
 * @author Melissa Ruiz
 */
public record MatriculaDTO(
        int id,
        int year,
        List<AsignaturaDTO> asignaturas
) {}
