package es.iespuerto.mr.institutov2.entity;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;


/**
 * The persistent class for the asignaturas database table.
 * 
 */
@Entity
@Table(name="asignaturas")
@NamedQuery(name="AsignaturaEntity.findAll", query="SELECT a FROM AsignaturaEntity a")
public class AsignaturaEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private String curso;

	private String nombre;

	//bi-directional many-to-many association to MatriculaEntity
	@ManyToMany
	@JoinColumn(name="id")
	private List<MatriculaEntity> matriculas;

	public AsignaturaEntity() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getCurso() {
		return this.curso;
	}

	public void setCurso(String curso) {
		this.curso = curso;
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

}