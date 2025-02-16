package es.iespuerto.instituto.dto;

import java.util.Date;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;

/**
 * Manejo de atributos record de alumno
 * @param dni del alumno
 * @param nombre del alumno
 * @param apellidos del alumno
 * @param fechanacimiento del alumno
 * @param imagen del alumno
 * @param matriculas del alumno
 *
 * @author Melissa Ruiz
 */
public record AlumnoDTO(
        String dni,
        String nombre,
        String apellidos,
        Date fechanacimiento,
        String imagen,
        @JsonIgnore List<MatriculaDTO> matriculas
) {}

