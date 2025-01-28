package com.es.iespuerto.mr.Gente.domain.ports.primary;

import com.es.iespuerto.mr.Gente.domain.model.Persona;

public interface IPersonaService {
    Persona crear(String nombre, int edad);
}
