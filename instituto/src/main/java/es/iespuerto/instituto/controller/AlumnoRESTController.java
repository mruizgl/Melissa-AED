package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;
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

    @Autowired
    private AlumnoService alumnoService;

    @GetMapping
    public ResponseEntity<List<AlumnoDTO>> findAllAlumnos() {
        List<AlumnoDTO> alumnos = alumnoService.findAll();

        if (alumnos.isEmpty()) {
            logger.info("No se encontraron alumnos.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron " + alumnos.size() + " alumnos.");
        return ResponseEntity.ok(alumnos);
    }
}




