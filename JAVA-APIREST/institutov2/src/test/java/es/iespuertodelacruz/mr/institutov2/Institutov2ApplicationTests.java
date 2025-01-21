package es.iespuertodelacruz.mr.institutov2;

import es.iespuertodelacruz.mr.institutov2.entities.Alumno;
import es.iespuertodelacruz.mr.institutov2.repository.IAlumnoRepository;
import es.iespuertodelacruz.mr.institutov2.services.AlumnoService;
import org.junit.jupiter.api.MethodOrderer;
import org.junit.jupiter.api.Order;
import org.junit.jupiter.api.Test;
import org.junit.jupiter.api.TestMethodOrder;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.test.context.SpringBootTest;
import org.springframework.test.context.ActiveProfiles;
import org.springframework.test.context.jdbc.Sql;

import java.util.ArrayList;
import java.util.List;

import static org.junit.jupiter.api.Assertions.assertTrue;

@SpringBootTest
@ActiveProfiles("test")
@TestMethodOrder(value = MethodOrderer.OrderAnnotation.class)
@Sql("/database.sql")
class Institutov2ApplicationTests {

	@Test
	void contextLoads() {
	}

	@Autowired
	IAlumnoRepository alumnoRepository;
	@Test
	@Order(2)
	void testGetAll() {
		System.out.println("GetAll");

		List<Alumno> alumnos;
		alumnos =  alumnoRepository.findAll();

		assertTrue(alumnos.size() == 2);
	}

}
