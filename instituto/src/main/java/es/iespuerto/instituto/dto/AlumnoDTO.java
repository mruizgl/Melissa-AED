package es.iespuerto.instituto.dto;

import java.util.Date;
import java.util.List;

import com.fasterxml.jackson.annotation.JsonIgnore;

public record AlumnoDTO(
        String dni,
        String nombre,
        String apellidos,
        Date fechanacimiento,
        String imagen,
        @JsonIgnore List<MatriculaDTO> matriculas
) {}

