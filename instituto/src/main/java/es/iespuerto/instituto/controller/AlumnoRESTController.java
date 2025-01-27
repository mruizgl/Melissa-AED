package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.mapper.mapstruc.AlumnoMapper;
import es.iespuerto.instituto.service.AlumnoService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.List;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v1/alumnos")
@CrossOrigin
public class AlumnoRESTController {

    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    private final AlumnoMapper alumnoMapper = AlumnoMapper.INSTANCE;

    @Autowired
    private AlumnoService alumnoService;

    @GetMapping
    public ResponseEntity<List<AlumnoDTO>> findAllAlumnos() {
        List<AlumnoDTO> alumnos = alumnoService.findAll().stream().map(alumno -> new AlumnoDTO(alumno.getDni(),
                alumno.getNombre(), alumno.getApellidos(), alumno.getFechanacimiento(), alumno.getImagen(),
                alumno.getMatriculas().stream().map(matricula ->
                new MatriculaDTO(matricula.getId(), matricula.getYear(),
                        matricula.getAsignaturas().stream().map(asignatura -> new AsignaturaDTO(asignatura.getId(),
                                asignatura.getCurso(), asignatura.getNombre())).collect(Collectors.toList();

        if (alumnos.isEmpty()) {
            logger.info("No se encontraron alumnos.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron " + alumnos.size() + " alumnos.");
        return ResponseEntity.ok(alumnos);
    }
}




