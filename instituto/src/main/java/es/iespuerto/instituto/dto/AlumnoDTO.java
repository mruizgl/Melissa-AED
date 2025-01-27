package es.iespuerto.instituto.dto;

import java.util.List;

public record AlumnoDTO(
        String dni,
        String nombre,
        String apellidos,
        long fechanacimiento,
        String imagen,
        List<MatriculaDTO> matriculas
) {}
