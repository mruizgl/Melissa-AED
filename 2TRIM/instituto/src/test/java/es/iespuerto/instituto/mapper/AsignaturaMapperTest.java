package es.iespuerto.instituto.mapper;


import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.mapper.classic.AsignaturaMapper;
import org.junit.jupiter.api.Test;

import java.util.Collections;
import java.util.List;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertNotNull;

public class AsignaturaMapperTest {

    @Test
    void testToDTO() {
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setNombre("Math");
        asignatura.setCurso("2023");

        AsignaturaDTO asignaturaDTO = AsignaturaMapper.toDTO(asignatura);

        assertNotNull(asignaturaDTO);
        assertEquals(asignatura.getId(), asignaturaDTO.id());
        assertEquals(asignatura.getNombre(), asignaturaDTO.nombre());
        assertEquals(asignatura.getCurso(), asignaturaDTO.curso());
    }

    @Test
    void testToEntity() {
        AsignaturaDTO asignaturaDTO = new AsignaturaDTO(1, "Math", "2023");

        Asignatura asignatura = AsignaturaMapper.toEntity(asignaturaDTO);

        assertNotNull(asignatura);
        assertEquals(asignaturaDTO.id(), asignatura.getId());
        assertEquals(asignaturaDTO.nombre(), asignatura.getNombre());
        assertEquals(asignaturaDTO.curso(), asignatura.getCurso());
    }

    @Test
    void testToDTOList() {
        Asignatura asignatura = new Asignatura();
        asignatura.setId(1);
        asignatura.setNombre("Math");
        asignatura.setCurso("2023");

        List<Asignatura> asignaturas = Collections.singletonList(asignatura);
        List<AsignaturaDTO> asignaturaDTOList = AsignaturaMapper.toDTOList(asignaturas);

        assertNotNull(asignaturaDTOList);
        assertEquals(1, asignaturaDTOList.size());
        assertEquals(asignatura.getId(), asignaturaDTOList.get(0).id());
        assertEquals(asignatura.getNombre(), asignaturaDTOList.get(0).nombre());
        assertEquals(asignatura.getCurso(), asignaturaDTOList.get(0).curso());
    }

    @Test
    void testToEntityList() {
        AsignaturaDTO asignaturaDTO = new AsignaturaDTO(1, "Math", "2023");

        List<AsignaturaDTO> asignaturaDTOList = Collections.singletonList(asignaturaDTO);
        List<Asignatura> asignaturas = AsignaturaMapper.toEntityList(asignaturaDTOList);

        assertNotNull(asignaturas);
        assertEquals(1, asignaturas.size());
        assertEquals(asignaturaDTO.id(), asignaturas.get(0).getId());
        assertEquals(asignaturaDTO.nombre(), asignaturas.get(0).getNombre());
        assertEquals(asignaturaDTO.curso(), asignaturas.get(0).getCurso());
    }
}
