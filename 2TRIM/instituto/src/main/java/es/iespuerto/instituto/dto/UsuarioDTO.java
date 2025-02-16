package es.iespuerto.instituto.dto;

import java.util.Date;

public record UsuarioDTO(
        String dni,
        String correo,
        Date fechaCreacion,
        String nombre,
        String password,
        String rol
) {}
