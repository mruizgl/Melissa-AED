package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.UsuarioDTO;
import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.service.UsuarioService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.junit.jupiter.MockitoExtension;
import org.springframework.http.ResponseEntity;

import java.util.Arrays;
import java.util.List;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.mockito.Mockito.when;

@ExtendWith(MockitoExtension.class)
public class UsuarioRESTControllerTest {
    @Mock
    private UsuarioService usuarioService;

    @InjectMocks
    private UsuarioRESTController usuarioRESTController;

    private Usuario usuario;

    @BeforeEach
    void setUp() {
        usuario = new Usuario();
        usuario.setDni("ejemplo");
        usuario.setName("pepito");
        usuario.setPassword("pass");
        usuario.setEmail("email");
    }

    @Test
    void testFindAllAlumnos() {


        when(usuarioService.findAll()).thenReturn(Arrays.asList(usuario));

        ResponseEntity<List<UsuarioDTO>> response = usuarioRESTController.findAllUsuarios();

        assertEquals(200, response.getStatusCodeValue());
        assertEquals(1, response.getBody().size());
        assertEquals("pepito", response.getBody().get(0).name());
        assertEquals("pass", response.getBody().get(0).password());
        assertEquals("email", response.getBody().get(0).email());
    }
}
