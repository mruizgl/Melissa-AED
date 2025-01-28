package es.iespuerto.instituto.dto;

/**
 * Manejo de atributos record de asignaturas
 * @param id asignatura
 * @param curso asignatura
 * @param nombre de asignatura
 */
public record AsignaturaDTO(
        int id,
        String curso,
        String nombre
) {}
