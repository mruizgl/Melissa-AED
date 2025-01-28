package com.es.iespuerto.mr.Gente.domain.service;

import com.es.iespuerto.mr.Gente.domain.model.Persona;
import com.es.iespuerto.mr.Gente.domain.ports.primary.IPersonaService;
import com.es.iespuerto.mr.Gente.domain.ports.secondary.IPersonaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class PersonaDomainService implements IPersonaService {

    @Autowired
    IPersonaRepository repository;

    @Override
    public Persona crear(String nombre, int edad) {
        Persona persona = new Persona(nombre, edad);
        return repository.save(persona);
    }
}
