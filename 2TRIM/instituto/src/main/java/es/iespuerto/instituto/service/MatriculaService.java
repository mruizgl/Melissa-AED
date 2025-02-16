package es.iespuerto.instituto.service;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.entities.Matricula;
import es.iespuerto.instituto.repository.IMatriculaRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

/**
 * Servicio de matriculas
 *
 * @author Melissa Ruiz
 */
@Service
public class MatriculaService implements IServiceGeneric<Matricula, Integer>{
    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    @Autowired
    IMatriculaRepository repository;

    @Override
    public List<Matricula> findAll() {
        List<Matricula> matriculas = repository.findAll();
        if (matriculas.isEmpty()) {
            logger.info("No se encontraron matriculas.");
        }
        return matriculas;
    }

    @Override
    public Matricula findById(Integer id) {
        Matricula matricula = repository.findById(id).orElse(null);
        if (matricula == null) {
            logger.info("Matricula no encontrada con id: " + id);
        }
        return matricula;
    }

    @Override
    public Matricula save(Matricula matricula) {
        Matricula savedMatricula = repository.save(matricula);
        return savedMatricula;
    }

    @Override
    public boolean delete(Integer id) {
        Optional<Matricula> matricula = repository.findById(id);
        if (matricula.isPresent()) {
            repository.deleteById(id);
            return true;
        }
        return false;
    }

    @Override
    public boolean update(Matricula matricula) {
        if (matricula != null ) {
            Matricula existingMatricula = repository.findById(matricula.getId()).orElse(null);
            if (existingMatricula != null) {
                existingMatricula.setAlumno(matricula.getAlumno());
                existingMatricula.setAsignaturas(matricula.getAsignaturas().stream()
                        .map(asignatura -> new Asignatura(
                                asignatura.getId(),
                                asignatura.getMatriculas(),
                                asignatura.getCurso(),
                                asignatura.getNombre()
                        )).collect(Collectors.toList())
                );
                repository.save(existingMatricula);
                return true;
            }
        }
        return false;
    }
}
