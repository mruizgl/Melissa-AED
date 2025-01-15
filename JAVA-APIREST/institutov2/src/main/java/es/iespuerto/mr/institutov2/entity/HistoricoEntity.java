package es.iespuerto.mr.institutov2.entity;

import java.io.Serializable;
import jakarta.persistence.*;


/**
 * The persistent class for the historicos database table.
 * 
 */
@Entity
@Table(name="historicos")
@NamedQuery(name="HistoricoEntity.findAll", query="SELECT h FROM HistoricoEntity h")
public class HistoricoEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private float equivalenteeuro;

	private String fecha;

	//bi-directional many-to-one association to MonedaEntity
	@ManyToOne
	private MonedaEntity moneda;

	public HistoricoEntity() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public float getEquivalenteeuro() {
		return this.equivalenteeuro;
	}

	public void setEquivalenteeuro(float equivalenteeuro) {
		this.equivalenteeuro = equivalenteeuro;
	}

	public String getFecha() {
		return this.fecha;
	}

	public void setFecha(String fecha) {
		this.fecha = fecha;
	}

	public MonedaEntity getMoneda() {
		return this.moneda;
	}

	public void setMoneda(MonedaEntity moneda) {
		this.moneda = moneda;
	}

}