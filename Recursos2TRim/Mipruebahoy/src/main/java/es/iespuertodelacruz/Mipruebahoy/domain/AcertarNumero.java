package es.iespuertodelacruz.Mipruebahoy.domain;

import es.iespuertodelacruz.Mipruebahoy.utils.Globals;

public class AcertarNumero {
    private Integer secreto;

    public Integer getMinimo() {
        return minimo;
    }

    public Integer getMaximo() {
        return maximo;
    }

    private Integer minimo;
    private Integer maximo;

    public boolean isNoactiva() {
        return noactiva;
    }

    private boolean noactiva;

    private static AcertarNumero acertarNumero;

    private int generarAleatorio(int minimo, int maximo) {
        return (int) (Math.random()* (maximo - minimo + 1) + minimo);
    }

    private AcertarNumero() {
        noactiva = true;
    }

    public synchronized boolean iniciarReiniciarPartida() {
        if(noactiva) {
            generarAleatorio(Globals.MINIMOALEATORIO, Globals.MAXIMOALEATORIO);
            noactiva = false;
        }
        return noactiva;

    }

    public static synchronized AcertarNumero getInstance() {
        if ( acertarNumero == null) {
            acertarNumero = new AcertarNumero();
        }
        return acertarNumero;
    }


    public synchronized String apostar(int apuesta) {
        String respuesta = "";
        if (noactiva) {
            respuesta = "partida no activa. No se puede apostar";
        }else if (apuesta < minimo || apuesta > maximo){
            respuesta = "el número no está entre el mínimo y el máximo";
        }else if (apuesta == secreto) {
            respuesta = "bravo! acertaste el secreto: " + secreto;
            noactiva = true;
        }else if (secreto < apuesta) {
            respuesta = "secreto es menor que " + apuesta;
        }else if (secreto > apuesta) {
            respuesta = "secreto es mayor que " + apuesta;
        }
        return respuesta;
    }




}
