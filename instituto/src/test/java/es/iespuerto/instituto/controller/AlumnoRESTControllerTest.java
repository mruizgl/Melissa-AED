package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.repository.IAlumnoRepository;
import es.iespuerto.instituto.repository.IAsignaturaRepository;
import es.iespuerto.instituto.repository.IMatriculaRepository;
import es.iespuerto.instituto.service.AlumnoService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.InjectMocks;
import org.mockito.Mockito;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.boot.test.mock.mockito.MockBean;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;

import java.util.Arrays;
import java.util.Date;
import java.util.List;

import static org.junit.jupiter.api.Assertions.*;

@SpringBootTest
public class AlumnoRESTControllerTest {

    @MockBean
    private AlumnoService alumnoService;

    @Autowired
    private AlumnoRESTController alumnoRESTController;

    @Test
    public void testFindAllAlumnos() {
        // Prepare mock data
        Alumno alumno = new Alumno();
        alumno.setDni("12345678A");
        alumno.setNombre("Juan");
        alumno.setApellidos("Pérez");
        alumno.setFechanacimiento(new Date());
        alumno.setImagen("imagen.jpg");

        List<Alumno> alumnos = Arrays.asList(alumno);

        // Mock the service call
        Mockito.when(alumnoService.findAll()).thenReturn(alumnos);

        // Call the method
        ResponseEntity<List<AlumnoDTO>> response = alumnoRESTController.findAllAlumnos();

        // Assertions
        assertEquals(HttpStatus.OK, response.getStatusCode());
        assertNotNull(response.getBody());
        assertFalse(response.getBody().isEmpty());
        assertEquals(1, response.getBody().size());
    }
}
