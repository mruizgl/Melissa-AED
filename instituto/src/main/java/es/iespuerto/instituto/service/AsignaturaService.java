package es.iespuerto.instituto.service;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.repository.IAsignaturaRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;


@Service
public class AsignaturaService implements IServiceGeneric<Asignatura, Integer> {
    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    @Autowired
    IAsignaturaRepository repository;

    @Override
    public List<Asignatura> findAll() {
        List<Asignatura> asignaturas = repository.findAll();
        if (asignaturas.isEmpty()) {
            logger.info("No se encontraron asignaturas.");
        }
        return asignaturas;
    }

    @Override
    public Asignatura findById(Integer id) {
        Asignatura asignatura = repository.findById(id).orElse(null);
        if (asignatura == null) {
            logger.info("Asignatura no encontrada con id: " + id);
        }
        return asignatura;
    }

    @Override
    public Asignatura save(Asignatura asignatura) {
        Asignatura savedAsignatura = repository.save(asignatura);
        return savedAsignatura;
    }

    @Override
    public boolean delete(Integer id) {
        Optional<Asignatura> asignatura = repository.findById(id);
        if (asignatura.isPresent()) {
            repository.deleteById(id);
            return true;
        }
        return false;
    }

    @Override
    public boolean update(Asignatura asignatura) {
        if (asignatura != null ) {
            Asignatura existingAsignatura = repository.findById(asignatura.getId()).orElse(null);
            if (existingAsignatura != null) {
                existingAsignatura.setNombre(asignatura.getNombre());
                existingAsignatura.setCurso(asignatura.getCurso());
                repository.save(existingAsignatura);
                return true;
            }
        }
        return false;
    }
}