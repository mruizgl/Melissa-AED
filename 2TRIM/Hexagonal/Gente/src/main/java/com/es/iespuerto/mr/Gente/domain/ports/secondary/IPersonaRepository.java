package com.es.iespuerto.mr.Gente.domain.ports.secondary;

import com.es.iespuerto.mr.Gente.domain.model.Persona;

public interface IPersonaRepository {
    Persona save(Persona persona);
}
