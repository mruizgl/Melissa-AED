package es.iespuerto.instituto.dto;

import com.fasterxml.jackson.annotation.JsonIgnore;

import java.util.Date;
import java.util.List;

public record AlumnoDTO(
        String dni,
        String nombre,
        String apellidos,
        Date fechanacimiento,
        String imagen,
        List<MatriculaDTO> matriculas
) {
    @JsonIgnore
  public List<MatriculaDTO> matriculas(){
      return matriculas;
  }

}
