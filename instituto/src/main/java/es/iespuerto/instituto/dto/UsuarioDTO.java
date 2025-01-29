package es.iespuerto.instituto.dto;

import java.util.Date;

public record UsuarioDTO(
        int id,
        String correo,
        Date fechaCreacion,
        String nombre,
        String password,
        String rol
) {}
