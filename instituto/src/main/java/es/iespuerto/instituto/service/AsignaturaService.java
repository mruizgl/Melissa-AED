package es.iespuerto.instituto.service;

import es.iespuerto.instituto.entities.Asignatura;
import org.springframework.stereotype.Service;

import java.util.List;


@Service
public class AsignaturaService implements IServiceGeneric<Asignatura, Integer> {


    @Override
    public List<Asignatura> findAll() {
        return List.of();
    }

    @Override
    public Asignatura findById(Integer id) {
        return null;
    }

    @Override
    public Asignatura save(Asignatura asignatura) {
        return null;
    }

    @Override
    public boolean delete(Integer id) {
        return false;
    }

    @Override
    public boolean update(Asignatura asignatura) {
        return false;
    }
}