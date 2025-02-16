package es.iespuerto.instituto.service;

import java.util.List;
import java.util.Optional;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.repository.IAlumnoRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

/**
 * Servicio de alumnos
 *
 * @author Melissa Ruiz
 */
@Service
public class AlumnoService implements IServiceGeneric<Alumno, String> {
    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    @Autowired
    private IAlumnoRepository repository;


    @Override
    public List<Alumno> findAll() {
        List<Alumno> alumnos = repository.findAll();
        if (alumnos.isEmpty()) {
            logger.info("No se encontraron alumnos.");
        }
        return alumnos;
    }


    @Override
    public Alumno findById(String id) {
        Alumno alumno = repository.findById(id).orElse(null);
        if (alumno == null) {
            logger.info("Alumno no encontrado con DNI: " + id);
        }
        return alumno;
    }

    @Override
    @Transactional
    public Alumno save(Alumno alumno) {
        Alumno savedAlumno = repository.save(alumno);
        return savedAlumno;
    }


    @Override
    @Transactional
    public boolean delete(String id) {
        Optional<Alumno> alumno = repository.findById(id);
        if (alumno.isPresent()) {
            repository.deleteAlumnoByDNI(id);
            return true;
        } else {
            System.out.println("No se encuentra alumno por ese id");
            return false;
        }

    }

    @Override
    @Transactional
    public boolean update(Alumno alumno) {
        if (alumno != null && alumno.getDni() != null) {
            Alumno existingAlumno = repository.findById(alumno.getDni()).orElse(null);
            if (existingAlumno != null) {
                existingAlumno.setNombre(alumno.getNombre());
                existingAlumno.setApellidos(alumno.getApellidos());
                existingAlumno.setFechanacimiento(alumno.getFechanacimiento());
                existingAlumno.setMatriculas(alumno.getMatriculas());
                repository.save(existingAlumno);
                return true;
            }
        }
        return false;
    }
    /**
     * List<Alumno> alumnos = repository.findAll();
     *         if (alumnos.isEmpty()) {
     *             logger.info("No se encontraron alumnos.");
     *         }
     *         return alumnos.stream()
     *                 .map(alumnoMapper::alumnoToAlumnoDTO)
     *                 .collect(Collectors.toList());
     */
}

