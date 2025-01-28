package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.mapper.classic.AsignaturaMapper;
import es.iespuerto.instituto.service.AsignaturaService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

/**
 * Controlador para api REST de asignaturas
 *
 * @author Melissa Ruiz
 */
@RestController
@RequestMapping("/instituto/api/v1/asignaturas")
@CrossOrigin
public class AsignaturaRESTController {
    private static final Logger logger = LoggerFactory.getLogger(AsignaturaRESTController.class);

    private final AsignaturaService asignaturaService;

    @Autowired
    public AsignaturaRESTController(AsignaturaService asignaturaService) {
        this.asignaturaService = asignaturaService;
    }

    @GetMapping
    public ResponseEntity<List<AsignaturaDTO>> findAllAsignaturas() {
        List<AsignaturaDTO> asignaturas = AsignaturaMapper.toDTOList(asignaturaService.findAll());

        if (asignaturas.isEmpty()) {
            logger.info("No se encontraron asignaturas.");
            return ResponseEntity.noContent().build();
        }

        logger.info("Se encontraron {} asignaturas.", asignaturas.size());
        return ResponseEntity.ok(asignaturas);
    }

    @GetMapping("/{id}")
    public ResponseEntity<AsignaturaDTO> findAsignaturaById(@PathVariable int id) {
        Optional<Asignatura> asignaturaOpt = Optional.ofNullable(asignaturaService.findById(id));

        if (asignaturaOpt.isPresent()) {
            AsignaturaDTO asignaturaDTO = AsignaturaMapper.toDTO(asignaturaOpt.get());
            logger.info("Asignatura encontrada con ID: {}", id);
            return ResponseEntity.ok(asignaturaDTO);
        } else {
            logger.warn("No se encontró asignatura con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping
    public ResponseEntity<AsignaturaDTO> createAsignatura(@RequestBody AsignaturaDTO asignaturaDTO) {
        Asignatura asignatura = new Asignatura();
        asignatura.setCurso(asignaturaDTO.curso());
        asignatura.setNombre(asignaturaDTO.nombre());

        Asignatura savedAsignatura = asignaturaService.save(asignatura);
        AsignaturaDTO response = AsignaturaMapper.toDTO(savedAsignatura);

        logger.info("Nueva asignatura creada: {}", asignaturaDTO.nombre());
        return ResponseEntity.status(201).body(response);
    }

    @PutMapping("/{id}")
    public ResponseEntity<AsignaturaDTO> updateAsignatura(@PathVariable int id, @RequestBody AsignaturaDTO asignaturaDTO) {
        Optional<Asignatura> asignaturaOpt = Optional.ofNullable(asignaturaService.findById(id));

        if (asignaturaOpt.isPresent()) {
            Asignatura asignatura = asignaturaOpt.get();
            asignatura.setCurso(asignaturaDTO.curso());
            asignatura.setNombre(asignaturaDTO.nombre());

            Asignatura updatedAsignatura = asignaturaService.save(asignatura);
            AsignaturaDTO response = AsignaturaMapper.toDTO(updatedAsignatura);

            logger.info("Asignatura con ID: {} actualizada.", id);
            return ResponseEntity.ok(response);
        } else {
            logger.warn("No se encontró asignatura con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> deleteAsignatura(@PathVariable int id) {
        Optional<Asignatura> asignaturaOpt = Optional.ofNullable(asignaturaService.findById(id));

        if (asignaturaOpt.isPresent()) {
            asignaturaService.delete(id);
            logger.info("Asignatura con ID: {} eliminada.", id);
            return ResponseEntity.noContent().build();
        } else {
            logger.warn("No se encontró asignatura con ID: {}", id);
            return ResponseEntity.notFound().build();
        }
    }
}
