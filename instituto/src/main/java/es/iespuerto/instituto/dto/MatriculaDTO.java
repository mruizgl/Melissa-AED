package es.iespuerto.instituto.dto;

import java.util.List;

public record MatriculaDTO(
        int id,
        int year,
        AlumnoDTO alumno, // DTO de Alumno (puede ser nulo si no deseas incluirlo)
        List<AsignaturaDTO> asignaturas // Lista de DTOs de Asignatura
) {}
