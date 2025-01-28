package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.MatriculaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.mapper.classic.MatriculaMapper;
import es.iespuerto.instituto.service.MatriculaService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/instituto/api/v1/matriculas")
@CrossOrigin
public class MatriculaRESTController {
    private static final Logger logger = LoggerFactory.getLogger(MatriculaRESTController.class);

    private final MatriculaService matriculaService;

    @Autowired
    public MatriculaRESTController(MatriculaService matriculaService) {
        this.matriculaService = matriculaService;
    }

    @GetMapping
    public ResponseEntity<List<MatriculaDTO>> findAllMatriculas() {
        List<MatriculaDTO> matriculas = MatriculaMapper.toDTOList(matriculaService.findAll());

        if (matriculas.isEmpty()) {
            logger.info("No se encontraron matriculas.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron {} matriculas.", matriculas.size());
        return ResponseEntity.ok(matriculas);
    }

    @GetMapping("/{id}")
    public ResponseEntity<MatriculaDTO> findMatriculaById(@PathVariable int id) {
        Optional<Matricula> matriculaOpt = Optional.ofNullable(matriculaService.findById(id));

        if (matriculaOpt.isPresent()) {
            MatriculaDTO matriculaDTO = MatriculaMapper.toDTO(matriculaOpt.get());
            logger.info("Matricula encontrada con ID: {}", id);
            return ResponseEntity.ok(matriculaDTO);
        } else {
            logger.warn("No se encontró matricula con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping
    public ResponseEntity<MatriculaDTO> createMatricula(@RequestBody MatriculaDTO matriculaDTO) {
        Matricula matricula = new Matricula();
        matricula.setYear(matriculaDTO.year());


        List<Asignatura> asignaturas = MatriculaMapper.toAsignaturas(matriculaDTO.asignaturas());
        matricula.setAsignaturas(asignaturas);

        Matricula savedMatricula = matriculaService.save(matricula);
        MatriculaDTO response = MatriculaMapper.toDTO(savedMatricula);

        logger.info("Nueva matricula creada con ID: {}", savedMatricula.getId());
        return ResponseEntity.status(201).body(response);
    }

    @PutMapping("/{id}")
    public ResponseEntity<MatriculaDTO> updateMatricula(@PathVariable int id, @RequestBody MatriculaDTO matriculaDTO) {
        Optional<Matricula> matriculaOpt = Optional.ofNullable(matriculaService.findById(id));

        if (matriculaOpt.isPresent()) {
            Matricula matricula = matriculaOpt.get();
            matricula.setYear(matriculaDTO.year());

            // Actualizamos las asignaturas si es necesario
            List<Asignatura> asignaturas = MatriculaMapper.toAsignaturas(matriculaDTO.asignaturas());
            matricula.setAsignaturas(asignaturas);

            Matricula updatedMatricula = matriculaService.save(matricula);
            MatriculaDTO response = MatriculaMapper.toDTO(updatedMatricula);

            logger.info("Matricula con ID: {} actualizada.", id);
            return ResponseEntity.ok(response);
        } else {
            logger.warn("No se encontró matricula con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteMatricula(@PathVariable int id) {
        Optional<Matricula> matriculaOpt = Optional.ofNullable(matriculaService.findById(id));

        if (matriculaOpt.isPresent()) {
            matriculaService.delete(id);
            logger.info("Matricula con ID: {} eliminada.", id);
            return ResponseEntity.noContent().build();
        } else {
            logger.warn("No se encontró matricula con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }
}