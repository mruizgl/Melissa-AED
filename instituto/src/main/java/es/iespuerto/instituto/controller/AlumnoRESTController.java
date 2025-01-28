package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.dto.MatriculaDTO;

import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.mapper.classic.AlumnoMapper;
import es.iespuerto.instituto.service.AlumnoService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v1/alumnos")
@CrossOrigin
public class AlumnoRESTController {

    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    private final AlumnoService alumnoService;

    @Autowired
    public AlumnoRESTController(AlumnoService alumnoService) {
        this.alumnoService = alumnoService;
    }

    @GetMapping
    public ResponseEntity<List<AlumnoDTO>> findAllAlumnos() {

        List<AlumnoDTO> alumnos = AlumnoMapper.toDTOList(alumnoService.findAll());

        if (alumnos.isEmpty()) {
            logger.info("No se encontraron alumnos.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron {} alumnos.", alumnos.size());
        return ResponseEntity.ok(alumnos);
    }

    @GetMapping("/{dni}")
    public ResponseEntity<AlumnoDTO> findAlumnoByDni(@PathVariable String dni) {
        Optional<Alumno> alumnoOpt = Optional.ofNullable(alumnoService.findById(dni));

        if (alumnoOpt.isPresent()) {
            AlumnoDTO alumnoDTO = AlumnoMapper.toDTO(alumnoOpt.get());
            logger.info("Alumno encontrado con DNI: {}", dni);
            return ResponseEntity.ok(alumnoDTO);
        } else {
            logger.warn("No se encontró alumno con DNI: {}", dni);
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping
    public ResponseEntity<AlumnoDTO> createAlumno(@RequestBody AlumnoDTO alumnoDTO) {
        Alumno alumno = new Alumno();
        alumno.setDni(alumnoDTO.dni());
        alumno.setNombre(alumnoDTO.nombre());
        alumno.setApellidos(alumnoDTO.apellidos());
        alumno.setFechanacimiento(alumnoDTO.fechanacimiento());
        alumno.setImagen(alumnoDTO.imagen());

        Alumno savedAlumno = alumnoService.save(alumno);
        AlumnoDTO response = AlumnoMapper.toDTO(savedAlumno);

        logger.info("Nuevo alumno creado: {}", alumnoDTO.nombre());
        return ResponseEntity.status(201).body(response);
    }

    @PutMapping("/{dni}")
    public ResponseEntity<AlumnoDTO> updateAlumno(@PathVariable String dni, @RequestBody AlumnoDTO alumnoDTO) {
        Optional<Alumno> alumnoOpt = Optional.ofNullable(alumnoService.findById(dni));

        if (alumnoOpt.isPresent()) {
            Alumno alumno = alumnoOpt.get();
            alumno.setNombre(alumnoDTO.nombre());
            alumno.setApellidos(alumnoDTO.apellidos());
            alumno.setFechanacimiento(alumnoDTO.fechanacimiento());
            alumno.setImagen(alumnoDTO.imagen());

            Alumno updatedAlumno = alumnoService.save(alumno);
            AlumnoDTO response = AlumnoMapper.toDTO(updatedAlumno);

            logger.info("Alumno con DNI: {} actualizado.", dni);
            return ResponseEntity.ok(response);
        } else {
            logger.warn("No se encontró alumno con DNI: {}", dni);
            return ResponseEntity.notFound().build();
        }
    }

    @DeleteMapping("/{dni}")
    public ResponseEntity<Void> deleteAlumno(@PathVariable String dni) {
        Optional<Alumno> alumnoOpt = Optional.ofNullable(alumnoService.findById(dni));

        if (alumnoOpt.isPresent()) {
            alumnoService.delete(alumnoOpt.get().getDni());
            logger.info("Alumno con DNI: {} eliminado.", dni);
            return ResponseEntity.noContent().build();
        } else {
            logger.warn("No se encontró alumno con DNI: {}", dni);
            return ResponseEntity.notFound().build();
        }
    }
}
