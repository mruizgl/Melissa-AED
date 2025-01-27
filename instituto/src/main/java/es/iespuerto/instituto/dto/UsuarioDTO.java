package es.iespuerto.instituto.dto;

import java.security.Timestamp;

public record UsuarioDTO(
        long id,
        String email,
        String name,
        Timestamp createdAt,
        Timestamp updatedAt,
        Timestamp emailVerifiedAt
) {}
