package es.iespuerto.instituto.mapper.mapstruc;

import es.iespuerto.instituto.dto.AlumnoDTO;
import es.iespuerto.instituto.entities.Alumno;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Named;
import org.mapstruct.factory.Mappers;

import java.util.Date;

@Mapper
public interface AlumnoMapper {
    AlumnoMapper INSTANCE = Mappers.getMapper(AlumnoMapper.class);

    @Mapping(source = "fechanacimiento", target = "fechanacimiento", qualifiedByName = "dateToLong")
    AlumnoDTO alumnoToAlumnoDTO(Alumno alumno);

    @Named("dateToLong")
    default long map(Date value) {
        return value != null ? value.getTime() : 0L;
    }
}
