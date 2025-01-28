package com.es.iespuerto.mr.Gente.infrastructure.adapters.primary;

import com.es.iespuerto.mr.Gente.domain.model.Persona;
import com.es.iespuerto.mr.Gente.domain.ports.primary.IPersonaService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;


@RestController
@CrossOrigin
@RequestMapping("/api/personas")
public class PersonaRESTController {

    @Autowired
    IPersonaService personaService;

    @GetMapping
    public ResponseEntity<?> findById (int id) {


    }

    @PostMapping("/save")
    public ResponseEntity<?> guardar (PersonaDTO personaDTO) {
        Persona p = new Persona(personaDTO.id(), personaDTO.nombre(), personaDTO.edad());
        Persona saved =  personaService(p);

        PersonaDTO savedDTO= new PersonaDTO(saved.getId(), saved.getNombre(), saved.getEdad());
        return ResponseEntity.ok(savedDTO);
    }

}
