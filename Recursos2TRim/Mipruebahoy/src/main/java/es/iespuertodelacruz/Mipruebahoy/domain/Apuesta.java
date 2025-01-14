package es.iespuertodelacruz.Mipruebahoy.domain;

public class Apuesta {
    private int apuesta;
    private String resultado;

    public Apuesta(int apuesta, String resultado) {
        this.apuesta = apuesta;
        this.resultado = resultado;
    }

    public int getApuesta() {
        return apuesta;
    }

    public String getResultado() {
        return resultado;
    }
}

