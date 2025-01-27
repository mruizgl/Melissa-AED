package es.iespuerto.instituto.service;

import es.iespuerto.instituto.dto.AsignaturaDTO;
import es.iespuerto.instituto.entities.Asignatura;
import es.iespuerto.instituto.mapper.classic.AsignaturaMapper;
import es.iespuerto.instituto.repository.IAsignaturaRepository;
import jakarta.transaction.Transactional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.stream.Collectors;

@Service
public class AsignaturaService implements IServiceGeneric<Asignatura, AsignaturaDTO, Integer> {

    @Autowired
    IAsignaturaRepository repository;

    @Override
    @Transactional
    public List<AsignaturaDTO> findAll() {
        List<Asignatura> asignaturas = repository.findAll();
        return asignaturas.stream()
                .map(AsignaturaMapper::toAsignaturaDTO)
                .collect(Collectors.toList());
    }

    @Override
    @Transactional
    public AsignaturaDTO findById(Integer id) {
        Asignatura asignatura = repository.findById(id).orElse(null);
        return asignatura != null ? AsignaturaMapper.toAsignaturaDTO(asignatura) : null; // Convertir a DTO
    }

    @Override
    @Transactional
    public AsignaturaDTO save(Asignatura asignatura) {
        Asignatura savedAsignatura = repository.save(asignatura);
        return AsignaturaMapper.toAsignaturaDTO(savedAsignatura);
    }

    @Override
    @Transactional
    public boolean delete(Integer id) {
        if (repository.existsById(id)) {
            repository.deleteById(id);
            return true;
        }
        return false;
    }

    @Override
    @Transactional
    public boolean update(Asignatura asignatura) {
        if (asignatura != null && asignatura.getId() > 0) {
            Asignatura asignaturaBd = repository.findById(asignatura.getId()).orElse(null);

            if (asignaturaBd != null) {
                asignaturaBd.setNombre(asignatura.getNombre());
                asignaturaBd.setCurso(asignatura.getCurso());
                asignaturaBd.setMatriculas(asignatura.getMatriculas());
                repository.save(asignaturaBd);
                return true;
            }
        }
        return false;
    }
}