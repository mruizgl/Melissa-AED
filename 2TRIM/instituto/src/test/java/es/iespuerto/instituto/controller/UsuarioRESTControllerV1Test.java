package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.mapper.classic.UsuarioMapperClassic;
import es.iespuerto.instituto.service.UsuarioService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.junit.jupiter.MockitoExtension;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.mockito.ArgumentMatchers.any;
import static org.mockito.Mockito.when;

@ExtendWith(MockitoExtension.class)
public class UsuarioRESTControllerV1Test {

    @Mock
    private UsuarioService usuarioService;

    @InjectMocks
    private UsuarioRESTControllerV1 usuarioRESTControllerV1;

    private UsuarioDTO usuarioDTO;
    private Usuario usuario;

    @BeforeEach
    void setUp() {
        usuarioDTO = new UsuarioDTO("1", "email@example.com", new java.util.Date(), "pepito", "pass", "ROLE_USER");

        usuario = UsuarioMapperClassic.toEntity(usuarioDTO);
    }

    @Test
    void testCrearUsuario() {
        when(usuarioService.save(any(Usuario.class))).thenReturn(usuario);

        Usuario createdUsuario = usuarioRESTControllerV1.crearUsuario(usuarioDTO);

        assertEquals("email@example.com", createdUsuario.getCorreo());
        assertEquals("pepito", createdUsuario.getNombre());
        assertEquals("pass", createdUsuario.getPassword());
        assertEquals("ROLE_USER", createdUsuario.getRol());
    }
}