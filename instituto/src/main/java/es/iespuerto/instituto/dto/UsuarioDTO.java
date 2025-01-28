package es.iespuerto.instituto.dto;

import java.security.Timestamp;

public record UsuarioDTO(
        String email,
        String name,
        String password

) {}
