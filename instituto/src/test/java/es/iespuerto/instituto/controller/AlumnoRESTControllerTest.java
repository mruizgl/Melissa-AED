package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.service.AlumnoService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.extension.ExtendWith;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.junit.jupiter.MockitoExtension;
import org.springframework.http.ResponseEntity;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Date;
import java.util.List;

import static org.mockito.ArgumentMatchers.any;
import static org.mockito.Mockito.when;
import static org.junit.jupiter.api.Assertions.assertEquals;

@ExtendWith(MockitoExtension.class)
public class AlumnoRESTControllerTest {

    @Mock
    private AlumnoService alumnoService;

    @InjectMocks
    private AlumnoRESTController alumnoRESTController;

    private Alumno alumno;

    @BeforeEach
    void setUp() {
        alumno = new Alumno();
        alumno.setDni("12345678A");
        alumno.setNombre("Juan");
        alumno.setApellidos("Pérez");
        alumno.setFechanacimiento(new Date(1000000000000L));
    }

    @Test
    void testFindAllAlumnos() {
        Alumno alumno = new Alumno();
        alumno.setDni("12345678A");
        alumno.setNombre("Juan");
        alumno.setApellidos("Pérez");

        when(alumnoService.findAll()).thenReturn(Arrays.asList(alumno));

        ResponseEntity<List<AlumnoDTO>> response = alumnoRESTController.findAllAlumnos();

        assertEquals(200, response.getStatusCodeValue());
        assertEquals(1, response.getBody().size());
    }

    @Test
    void testFindAlumnoByDni() {
        when(alumnoService.findById("12345678A")).thenReturn(alumno);

        ResponseEntity<AlumnoDTO> response = alumnoRESTController.findAlumnoByDni("12345678A");

        assertEquals(200, response.getStatusCodeValue());
        assertEquals("Juan", response.getBody().nombre());
        assertEquals("Pérez", response.getBody().apellidos());
        assertEquals(alumno.getFechanacimiento().getTime(), response.getBody().fechanacimiento().getTime());
    }

    @Test
    void testCreateAlumno() {
        List<MatriculaDTO> matriculaDTOS = new ArrayList<>();
        List<AsignaturaDTO> asignaturas = new ArrayList<>();
        asignaturas.add(new AsignaturaDTO(1, "1ºDAM", "Desarrollo"));
        matriculaDTOS.add(new MatriculaDTO(1, 1999, asignaturas));

        AlumnoDTO alumnoDTO = new AlumnoDTO("12345678A", "Juan", "Pérez", new Date(1000000000000L), null, matriculaDTOS);

        // Stubbing de los métodos del servicio que se llaman durante el flujo
        when(alumnoService.save(any(Alumno.class))).thenReturn(alumno);

        // Llamada al controlador para crear el alumno
        ResponseEntity<AlumnoDTO> response = alumnoRESTController.createAlumno(alumnoDTO);

        // Comprobaciones
        assertEquals(201, response.getStatusCodeValue());  // Código de respuesta esperado
        assertEquals("Juan", response.getBody().nombre());  // Nombre esperado
        assertEquals("Pérez", response.getBody().apellidos());  // Apellidos esperados
        assertEquals(alumnoDTO.fechanacimiento().getTime(), response.getBody().fechanacimiento().getTime());  // Comprobación de fecha de nacimiento
    }

    @Test
    void testUpdateAlumno() {
        AlumnoDTO alumnoDTO = new AlumnoDTO("455", "Test", "Prueba", new Date(1000000000000L), "imagen.jpg", new ArrayList<>());

        // Stubbing del servicio para el método findById
        when(alumnoService.findById("12345678A")).thenReturn(alumno);
        // Stubbing del servicio para el método save (actualización)
        when(alumnoService.save(any(Alumno.class))).thenReturn(alumno);

        // Llamada al controlador
        ResponseEntity<AlumnoDTO> response = alumnoRESTController.updateAlumno("12345678A", alumnoDTO);

        // Comprobaciones
        assertEquals(200, response.getStatusCodeValue());  // Código de respuesta esperado
        assertEquals("Test", response.getBody().nombre());  // Nombre actualizado
        assertEquals("Prueba", response.getBody().apellidos());  // Apellidos actualizados
        assertEquals(alumnoDTO.fechanacimiento().getTime(), response.getBody().fechanacimiento().getTime());  // Fecha de nacimiento actualizada
        assertEquals("imagen.jpg", response.getBody().imagen());  // Imagen actualizada
    }

    @Test
    void testUpdateAlumnoNotFound() {
        // Stubbing del servicio para el método findById (no se encuentra el alumno)
        when(alumnoService.findById("12345678A")).thenReturn(null);

        // Crear un AlumnoDTO con los datos que se intentarán actualizar
        AlumnoDTO alumnoDTO = new AlumnoDTO("12345678A", "Juan", "Pérez", new Date(1000000000000L), "imagen.jpg", new ArrayList<>());

        // Llamada al controlador
        ResponseEntity<AlumnoDTO> response = alumnoRESTController.updateAlumno("12345678A", alumnoDTO);

        // Comprobaciones
        assertEquals(404, response.getStatusCodeValue());  // Código de respuesta esperado cuando no se encuentra el alumno
    }

    @Test
    void testDeleteAlumno() {


        // Stubbing del servicio para el método findById
        when(alumnoService.findById("12345678A")).thenReturn(alumno);

        // Llamada al controlador para eliminar el alumno
        ResponseEntity<Void> response = alumnoRESTController.deleteAlumno("12345678A");

        // Comprobaciones
        assertEquals(204, response.getStatusCodeValue());  // Código de respuesta esperado (sin contenido)
    }

    @Test
    void testDeleteAlumnoNotFound() {

        when(alumnoService.findById("12345678A")).thenReturn(null);

        ResponseEntity<Void> response = alumnoRESTController.deleteAlumno("12345678A");

        assertEquals(404, response.getStatusCodeValue());  // Código de respuesta esperado cuando no se encuentra el alumno
    }

}
