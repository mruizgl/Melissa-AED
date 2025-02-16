package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.mapper.classic.MatriculaMapper;
import es.iespuerto.instituto.service.MatriculaService;
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

class MatriculaRESTControllerTest {

    private MockMvc mockMvc;

    @Mock
    private MatriculaService matriculaService;

    @InjectMocks
    private MatriculaRESTController matriculaRESTController;

    @BeforeEach
    void setUp() {
        MockitoAnnotations.openMocks(this);
        mockMvc = MockMvcBuilders.standaloneSetup(matriculaRESTController).build();
    }

    @Test
    void testFindAllMatriculas() throws Exception {
        MatriculaDTO matriculaDTO = new MatriculaDTO(1, 2023, Collections.emptyList());
        List<MatriculaDTO> matriculaDTOList = Collections.singletonList(matriculaDTO);

        when(matriculaService.findAll()).thenReturn(Collections.singletonList(new Matricula()));
        when(MatriculaMapper.toDTOList(anyList())).thenReturn(matriculaDTOList);

        mockMvc.perform(get("/instituto/api/v1/matriculas"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$[0]").exists());

        verify(matriculaService, times(1)).findAll();
    }

    @Test
    void testFindMatriculaById() throws Exception {
        MatriculaDTO matriculaDTO = new MatriculaDTO(1, 2023, Collections.emptyList());
        Matricula matricula = new Matricula();

        when(matriculaService.findById(anyInt())).thenReturn(matricula);
        when(MatriculaMapper.toDTO(any(Matricula.class))).thenReturn(matriculaDTO);

        mockMvc.perform(get("/instituto/api/v1/matriculas/{id}", 1))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.id").exists());

        verify(matriculaService, times(1)).findById(anyInt());
    }

    @Test
    void testCreateMatricula() throws Exception {
        MatriculaDTO matriculaDTO = new MatriculaDTO(1, 2023, Collections.emptyList());
        Matricula matricula = new Matricula();

        when(matriculaService.save(any(Matricula.class))).thenReturn(matricula);
        when(MatriculaMapper.toDTO(any(Matricula.class))).thenReturn(matriculaDTO);

        mockMvc.perform(post("/instituto/api/v1/matriculas")
                        .contentType(MediaType.APPLICATION_JSON)
                        .content("{\"year\":2023,\"asignaturas\":[]}"))
                .andExpect(status().isCreated())
                .andExpect(jsonPath("$.id").exists());

        verify(matriculaService, times(1)).save(any(Matricula.class));
    }

    @Test
    void testUpdateMatricula() throws Exception {
        MatriculaDTO matriculaDTO = new MatriculaDTO(1, 2023, Collections.emptyList());
        Matricula matricula = new Matricula();
        matricula.setId(1);
        matricula.setYear(2023);
        matricula.setAsignaturas(Collections.emptyList());

        when(matriculaService.findById(anyInt())).thenReturn(matricula);
        when(matriculaService.save(any(Matricula.class))).thenReturn(matricula);
        when(MatriculaMapper.toDTO(any(Matricula.class))).thenReturn(matriculaDTO);

        mockMvc.perform(put("/instituto/api/v1/matriculas/{id}", 1)
                        .contentType(MediaType.APPLICATION_JSON)
                        .content("{\"year\":2023,\"asignaturas\":[]}"))
                .andExpect(status().isOk())
                .andExpect(jsonPath("$.id").exists());

        verify(matriculaService, times(1)).findById(anyInt());
        verify(matriculaService, times(1)).save(any(Matricula.class));
    }

    @Test
    void testDeleteMatricula() throws Exception {
        Matricula matricula = new Matricula();

        when(matriculaService.findById(anyInt())).thenReturn(matricula);
        doNothing().when(matriculaService).delete(anyInt());

        mockMvc.perform(delete("/instituto/api/v1/matriculas/{id}", 1))
                .andExpect(status().isNoContent());

        verify(matriculaService, times(1)).findById(anyInt());
        verify(matriculaService, times(1)).delete(anyInt());
    }


}