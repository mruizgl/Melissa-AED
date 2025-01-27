package es.iespuerto.instituto.service;

import java.util.List;
import java.util.stream.Collectors;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.entities.Alumno;
import es.iespuerto.instituto.mapper.mapstruc.AlumnoMapper;
import es.iespuerto.instituto.repository.IAlumnoRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
public class AlumnoService implements IServiceGeneric<Alumno, AlumnoDTO, String> {
    private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);

    @Autowired
    private IAlumnoRepository repository;

    private final AlumnoMapper alumnoMapper = AlumnoMapper.INSTANCE;

    @Override
    public List<AlumnoDTO> findAll() {
        List<Alumno> alumnos = repository.findAll();
        if (alumnos.isEmpty()) {
            logger.info("No se encontraron alumnos.");
        }
        return alumnos.stream()
                .map(alumnoMapper::alumnoToAlumnoDTO)
                .collect(Collectors.toList());
    }

    @Override
    public AlumnoDTO findById(String id) {
        Alumno alumno = repository.findById(id).orElse(null);
        if (alumno == null) {
            logger.info("Alumno no encontrado con DNI: " + id);
        }
        return alumno != null ? alumnoMapper.alumnoToAlumnoDTO(alumno) : null;
    }

    @Override
    @Transactional
    public AlumnoDTO save(Alumno alumno) {
        Alumno savedAlumno = repository.save(alumno);
        return alumnoMapper.alumnoToAlumnoDTO(savedAlumno);
    }

    @Override
    @Transactional
    public boolean delete(String id) {
        int quantity = repository.deleteAlumnoByDNI(id);
        return quantity > 0;
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
}

