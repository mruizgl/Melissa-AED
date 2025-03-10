package es.iespuerto.instituto.entities;

import java.io.Serializable;
import jakarta.persistence.*;
import java.sql.Timestamp;


/**
 * Entidad de usuarios del sistema
 * @author Melissa Ruiz
 */
@Entity
@Table(name="usuarios")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario implements Serializable {
    private static final long serialVersionUID = 1L;

    @Id
    private String dni;

    @Column(name="fecha_creacion")
    private Long fechaCreacion;

    @Column(nullable=false, length=255, name="correo")
    private String correo;

    @Column(name="email_verified_at")
    private Timestamp emailVerifiedAt;

    @Column(nullable=false, length=255, name="nombre")
    private String nombre;

    @Column(nullable=false, length=255)
    private String password;

    @Column(nullable=false, length=45)
    private String rol;

    @Column(name="remember_token", length=100)
    private String rememberToken;

    @Column(name="updated_at")
    private Timestamp updatedAt;

    @Column(name="verificado")
    private int verificado;



    public Usuario() {
    }

    public Usuario(String dni, Long fechaCreacion, String correo, String nombre, String password, String rol) {
        this.dni = dni;
        this.fechaCreacion = fechaCreacion;
        this.correo = correo;
        this.nombre = nombre;
        this.password = password;
        this.rol = rol;
    }

    public Usuario(String dni, String correo, String nombre, String password) {
        this.dni = dni;
        this.correo = correo;
        this.nombre = nombre;
        this.password = password;
    }

    public String getRol() {
        return rol;
    }

    public void setRol(String rol) {
        this.rol = rol;
    }

    public int getVerificado() {
        return verificado;
    }

    public void setVerificado(int verificado) {
        this.verificado = verificado;
    }

    public String getDni() {
        return dni;
    }

    public void setDni(String dni) {
        this.dni = dni;
    }

    public Long getFechaCreacion() {
        return fechaCreacion;
    }

    public void setFechaCreacion(Long fechaCreacion) {
        this.fechaCreacion = fechaCreacion;
    }

    public String getCorreo() {
        return this.correo;
    }

    public void setCorreo(String correo) {
        this.correo = correo;
    }

    public Timestamp getEmailVerifiedAt() {
        return this.emailVerifiedAt;
    }

    public void setEmailVerifiedAt(Timestamp emailVerifiedAt) {
        this.emailVerifiedAt = emailVerifiedAt;
    }

    public String getNombre() {
        return this.nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getPassword() {
        return this.password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getRememberToken() {
        return this.rememberToken;
    }

    public void setRememberToken(String rememberToken) {
        this.rememberToken = rememberToken;
    }

    public Timestamp getUpdatedAt() {
        return this.updatedAt;
    }

    public void setUpdatedAt(Timestamp updatedAt) {
        this.updatedAt = updatedAt;
    }

}
