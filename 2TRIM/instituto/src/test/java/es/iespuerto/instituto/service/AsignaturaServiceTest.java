package es.iespuerto.instituto.service;

import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.repository.IAsignaturaRepository;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.MockitoAnnotations;

import java.util.Collections;
import java.util.List;
import java.util.Optional;

import static org.junit.jupiter.api.Assertions.*;
import static org.mockito.ArgumentMatchers.anyInt;
import static org.mockito.Mockito.*;

public class AsignaturaServiceTest {

    @Mock
    private IAsignaturaRepository asignaturaRepository;

    @InjectMocks
    private AsignaturaService asignaturaService;

    @BeforeEach
    void setUp() {
        MockitoAnnotations.openMocks(this);
    }

    @Test
    void testFindAll() {
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setNombre("Math");
        asignatura.setCurso("2023");

        when(asignaturaRepository.findAll()).thenReturn(Collections.singletonList(asignatura));

        List<Asignatura> result = asignaturaService.findAll();

        assertNotNull(result);
        assertEquals(1, result.size());
        assertEquals(asignatura.getId(), result.get(0).getId());
        assertEquals(asignatura.getNombre(), result.get(0).getNombre());
        assertEquals(asignatura.getCurso(), result.get(0).getCurso());
    }

    @Test
    void testFindById() {
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setNombre("Math");
        asignatura.setCurso("2023");

        when(asignaturaRepository.findById(anyInt())).thenReturn(Optional.of(asignatura));

        Asignatura result = asignaturaService.findById(1);

        assertNotNull(result);
        assertEquals(asignatura.getId(), result.getId());
        assertEquals(asignatura.getNombre(), result.getNombre());
        assertEquals(asignatura.getCurso(), result.getCurso());
    }

    @Test
    void testSave() {
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setNombre("Math");
        asignatura.setCurso("2023");

        when(asignaturaRepository.save(any(Asignatura.class))).thenReturn(asignatura);

        Asignatura result = asignaturaService.save(asignatura);

        assertNotNull(result);
        assertEquals(asignatura.getId(), result.getId());
        assertEquals(asignatura.getNombre(), result.getNombre());
        assertEquals(asignatura.getCurso(), result.getCurso());
    }


}
