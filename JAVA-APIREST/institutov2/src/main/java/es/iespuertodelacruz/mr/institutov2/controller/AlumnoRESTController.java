package es.iespuertodelacruz.nla.institutov2.controller;

import java.util.logging.Logger;
import es.iespuertodelacruz.nla.institutov2.dto.AlumnoDTO;
import es.iespuertodelacruz.nla.institutov2.services.AlumnoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;


import java.util.stream.Collectors;

@RestController
@RequestMapping("/instituto/api/v1/alumnos")
@CrossOrigin
public class AlumnoRESTController {

    @Autowired AlumnoService alumnoService;

    @GetMapping
    public ResponseEntity<?> findAllAlumnos(){

    	Logger logger = Logger.getLogger("logger");
    	
    	logger.info("esta es una prueba de logger");
    	return ResponseEntity.ok(alumnoService.findAll().stream().map(alumno -> new AlumnoDTO(
                alumno.getDni(), alumno.getApellidos(), alumno.getFechanacimiento(),
                alumno.getNombre(),alumno.getMatriculas())).collect(Collectors.toList()));
    }
    
  
    
}
