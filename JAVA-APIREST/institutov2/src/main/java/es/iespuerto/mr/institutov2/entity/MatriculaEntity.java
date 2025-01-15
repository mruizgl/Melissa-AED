package es.iespuerto.mr.institutov2.entity;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;


/**
 * The persistent class for the matriculas database table.
 * 
 */
@Entity
@Table(name="matriculas")
@NamedQuery(name="MatriculaEntity.findAll", query="SELECT m FROM MatriculaEntity m")
public class MatriculaEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private int year;

	//bi-directional many-to-one association to AlumnoEntity
	@ManyToOne
	@JoinColumn(name="dni")
	private AlumnoEntity alumno;

	//bi-directional many-to-many association to AsignaturaEntity
	@ManyToMany(mappedBy="matriculas")
	private List<AsignaturaEntity> asignaturas;

	public MatriculaEntity() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getYear() {
		return this.year;
	}

	public void setYear(int year) {
		this.year = year;
	}

	public AlumnoEntity getAlumno() {
		return this.alumno;
	}

	public void setAlumno(AlumnoEntity alumno) {
		this.alumno = alumno;
	}

	public List<AsignaturaEntity> getAsignaturas() {
		return this.asignaturas;
	}

	public void setAsignaturas(List<AsignaturaEntity> asignaturas) {
		this.asignaturas = asignaturas;
	}

}