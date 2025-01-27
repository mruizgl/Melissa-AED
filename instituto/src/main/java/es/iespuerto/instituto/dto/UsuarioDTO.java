package es.iespuerto.instituto.dto;

import java.security.Timestamp;

public record UsuarioDTO(
        long id,
        String email,
        String name

) {}
