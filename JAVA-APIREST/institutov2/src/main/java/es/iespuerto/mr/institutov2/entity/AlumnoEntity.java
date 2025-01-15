package es.iespuerto.mr.institutov2.entity;

import java.io.Serializable;
import jakarta.persistence.*;
import java.math.BigInteger;
import java.util.List;


/**
 * The persistent class for the alumnos database table.
 * 
 */
@Entity
@Table(name="alumnos")
@NamedQuery(name="AlumnoEntity.findAll", query="SELECT a FROM AlumnoEntity a")
public class AlumnoEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	private String dni;

	private String apellidos;

	private BigInteger fechanacimiento;

	private String nombre;

	//bi-directional many-to-one association to MatriculaEntity
	@OneToMany(mappedBy="alumno")
	private List<MatriculaEntity> matriculas;

	public AlumnoEntity() {
	}

	public String getDni() {
		return this.dni;
	}

	public void setDni(String dni) {
		this.dni = dni;
	}

	public String getApellidos() {
		return this.apellidos;
	}

	public void setApellidos(String apellidos) {
		this.apellidos = apellidos;
	}

	public BigInteger getFechanacimiento() {
		return this.fechanacimiento;
	}

	public void setFechanacimiento(BigInteger fechanacimiento) {
		this.fechanacimiento = fechanacimiento;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public List<MatriculaEntity> getMatriculas() {
		return this.matriculas;
	}

	public void setMatriculas(List<MatriculaEntity> matriculas) {
		this.matriculas = matriculas;
	}

	public MatriculaEntity addMatricula(MatriculaEntity matricula) {
		getMatriculas().add(matricula);
		matricula.setAlumno(this);

		return matricula;
	}

	public MatriculaEntity removeMatricula(MatriculaEntity matricula) {
		getMatriculas().remove(matricula);
		matricula.setAlumno(null);

		return matricula;
	}

}