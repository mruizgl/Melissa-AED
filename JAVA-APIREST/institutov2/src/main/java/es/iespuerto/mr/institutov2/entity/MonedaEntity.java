package es.iespuerto.mr.institutov2.entity;

import java.io.Serializable;
import jakarta.persistence.*;
import java.util.List;


/**
 * The persistent class for the monedas database table.
 * 
 */
@Entity
@Table(name="monedas")
@NamedQuery(name="MonedaEntity.findAll", query="SELECT m FROM MonedaEntity m")
public class MonedaEntity implements Serializable {
	private static final long serialVersionUID = 1L;

	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	private int id;

	private String nombre;

	private String pais;

	//bi-directional many-to-one association to HistoricoEntity
	@OneToMany(mappedBy="moneda")
	private List<HistoricoEntity> historicos;

	public MonedaEntity() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getPais() {
		return this.pais;
	}

	public void setPais(String pais) {
		this.pais = pais;
	}

	public List<HistoricoEntity> getHistoricos() {
		return this.historicos;
	}

	public void setHistoricos(List<HistoricoEntity> historicos) {
		this.historicos = historicos;
	}

	public HistoricoEntity addHistorico(HistoricoEntity historico) {
		getHistoricos().add(historico);
		historico.setMoneda(this);

		return historico;
	}

	public HistoricoEntity removeHistorico(HistoricoEntity historico) {
		getHistoricos().remove(historico);
		historico.setMoneda(null);

		return historico;
	}

}