package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.mapper.classic.AsignaturaMapper;
import es.iespuerto.instituto.service.AsignaturaService;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.mockito.InjectMocks;
import org.mockito.Mock;
import org.mockito.MockitoAnnotations;
import org.springframework.http.MediaType;
import org.springframework.test.web.servlet.MockMvc;
import org.springframework.test.web.servlet.setup.MockMvcBuilders;

import java.util.Collections;
import java.util.List;

import static org.mockito.ArgumentMatchers.any;
import static org.mockito.ArgumentMatchers.anyInt;
import static org.mockito.Mockito.*;
import static org.springframework.test.web.servlet.request.MockMvcRequestBuilders.*;
import static org.springframework.test.web.servlet.result.MockMvcResultMatchers.*;

class AsignaturaRESTControllerTest {

    private MockMvc mockMvc;

    @Mock
    private AsignaturaService asignaturaService;

    @InjectMocks
    private AsignaturaRESTController asignaturaRESTController;

    @BeforeEach
    void setUp() {
        MockitoAnnotations.openMocks(this);
        mockMvc = MockMvcBuilders.standaloneSetup(asignaturaRESTController).build();
    }

    @Test
    void findAllAsignaturas_noAsignaturas_returnsNoContent() throws Exception {
        when(asignaturaService.findAll()).thenReturn(Collections.emptyList());

        mockMvc.perform(get("/instituto/api/v1/asignaturas"))
                .andExpect(status().isNoContent());

        verify(asignaturaService, times(1)).findAll();
    }

    @Test
    void findAsignaturaById_asignaturaNotFound_returnsNotFound() throws Exception {
        when(asignaturaService.findById(anyInt())).thenReturn(null);

        mockMvc.perform(get("/instituto/api/v1/asignaturas/{id}", 1))
                .andExpect(status().isNotFound());

        verify(asignaturaService, times(1)).findById(anyInt());
    }

    @Test
    void createAsignatura_validInput_createsAsignatura() throws Exception {
        AsignaturaDTO asignaturaDTO = new AsignaturaDTO(1, "Math", "2023");
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setCurso("2023");
        asignatura.setNombre("Math");

        when(asignaturaService.save(any(Asignatura.class))).thenReturn(asignatura);
        when(AsignaturaMapper.toDTO(any(Asignatura.class))).thenReturn(asignaturaDTO);

        mockMvc.perform(post("/instituto/api/v1/asignaturas")
                        .contentType(MediaType.APPLICATION_JSON)
                        .content("{\"curso\":\"2023\",\"nombre\":\"Math\"}"))
                .andExpect(status().isCreated())
                .andExpect(jsonPath("$.id").exists());

        verify(asignaturaService, times(1)).save(any(Asignatura.class));
    }

    @Test
    void updateAsignatura_asignaturaNotFound_returnsNotFound() throws Exception {
        when(asignaturaService.findById(anyInt())).thenReturn(null);

        mockMvc.perform(put("/instituto/api/v1/asignaturas/{id}", 1)
                        .contentType(MediaType.APPLICATION_JSON)
                        .content("{\"curso\":\"2023\",\"nombre\":\"Math\"}"))
                .andExpect(status().isNotFound());

        verify(asignaturaService, times(1)).findById(anyInt());
    }

    @Test
    void deleteAsignatura_asignaturaNotFound_returnsNotFound() throws Exception {
        when(asignaturaService.findById(anyInt())).thenReturn(null);

        mockMvc.perform(delete("/instituto/api/v1/asignaturas/{id}", 1))
                .andExpect(status().isNotFound());

        verify(asignaturaService, times(1)).findById(anyInt());
    }
}