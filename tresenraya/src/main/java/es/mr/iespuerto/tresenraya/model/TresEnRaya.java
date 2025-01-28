package es.mr.iespuerto.tresenraya.model;

import jakarta.persistence.*;
import java.util.Arrays;

@Entity
public class TresEnRaya {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Enumerated(EnumType.STRING)
    private Estado estado;

    private char simboloJug1;
    private char simboloJug2;
    private String nickJug1;
    private String nickJug2 = "ordenador";
    private String turno;
    private String ganador;

    @Column(length = 9)
    private String tablero;

    public TresEnRaya() {
        this.estado = Estado.JUGANDO;
        this.tablero = "---------";
    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Estado getEstado() {
        return estado;
    }

    public void setEstado(Estado estado) {
        this.estado = estado;
    }

    public char getSimboloJug1() {
        return simboloJug1;
    }

    public void setSimboloJug1(char simboloJug1) {
        this.simboloJug1 = simboloJug1;
    }

    public char getSimboloJug2() {
        return simboloJug2;
    }

    public void setSimboloJug2(char simboloJug2) {
        this.simboloJug2 = simboloJug2;
    }

    public String getNickJug1() {
        return nickJug1;
    }

    public void setNickJug1(String nickJug1) {
        this.nickJug1 = nickJug1;
    }

    public String getNickJug2() {
        return nickJug2;
    }

    public String getTurno() {
        return turno;
    }

    public void setTurno(String turno) {
        this.turno = turno;
    }

    public String getGanador() {
        return ganador;
    }

    public void setGanador(String ganador) {
        this.ganador = ganador;
    }

    public String getTablero() {
        return tablero;
    }

    public void setTablero(String tablero) {
        this.tablero = tablero;
    }

    public char[][] getEscenario() {
        char[][] escenario = new char[3][3];
        for (int i = 0; i < 9; i++) {
            escenario[i / 3][i % 3] = tablero.charAt(i);
        }
        return escenario;
    }

    public void actualizarEscenario(int fila, int columna, char simbolo) {
        char[] tableroArr = tablero.toCharArray();
        tableroArr[fila * 3 + columna] = simbolo;
        this.tablero = new String(tableroArr);
    }

    @Override
    public String toString() {
        return "TresEnRaya{" +
                "id=" + id +
                ", estado=" + estado +
                ", nickJug1='" + nickJug1 + '\'' +
                ", nickJug2='" + nickJug2 + '\'' +
                ", tablero=" + Arrays.toString(getEscenario()) +
                '}';
    }
}