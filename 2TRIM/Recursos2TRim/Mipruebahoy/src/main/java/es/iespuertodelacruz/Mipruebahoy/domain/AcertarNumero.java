package es.iespuertodelacruz.Mipruebahoy.domain;

import es.iespuertodelacruz.Mipruebahoy.utils.Globals;

import java.util.ArrayList;
import java.util.List;

/**
 * Clase que representa el juego "Acertar Número".
 * Gestiona el número secreto, el rango de apuestas y las reglas del juego.
 *
 * @author Melissa Ruiz
 */
public class AcertarNumero {

    private Integer secreto;
    private Integer minimo;
    private Integer maximo;
    private boolean noactiva;
    private List<Apuesta> historialApuestas;

    private static AcertarNumero acertarNumero;

    /**
     * Genera un número aleatorio dentro del rango especificado.
     *
     * @param minimo el límite inferior del rango
     * @param maximo el límite superior del rango
     * @return un número aleatorio entre minimo y maximo
     */
    private int generarAleatorio(int minimo, int maximo) {
        return (int) (Math.random() * (maximo - minimo + 1) + minimo);
    }

    /**
     * Constructor privado para la clase AcertarNumero, utilizado en el patrón Singleton.
     * Inicializa el estado de la partida como no activa.
     */
    private AcertarNumero() {
        noactiva = true;
    }

    /**
     * Inicia o reinicia la partida generando un nuevo número secreto dentro del rango definido.
     *
     * @return true si la partida se ha iniciado correctamente, false si ya estaba activa
     */
    public synchronized boolean iniciarReiniciarPartida() {
        if (noactiva) {
            this.minimo = Globals.MINIMOALEATORIO; // Establece el límite mínimo para el número secreto
            this.maximo = Globals.MAXIMOALEATORIO; // Establece el límite máximo para el número secreto
            this.secreto = generarAleatorio(minimo, maximo); // Genera un nuevo número secreto
            noactiva = false; // Marca la partida como activa
        }
        return !noactiva; // Devuelve el estado de la partida
    }

    /**
     * Devuelve la instancia única de la clase AcertarNumero.
     *
     * @return la única instancia de AcertarNumero
     */
    public static synchronized AcertarNumero getInstance() {
        if (acertarNumero == null) {
            acertarNumero = new AcertarNumero(); // Crea una nueva instancia si no existe
        }
        return acertarNumero;
    }

    /**
     * Realiza una apuesta en el juego y devuelve el resultado.
     *
     * @param apuesta el número que el jugador ha apostado
     * @return una cadena con el resultado de la apuesta
     */
    public synchronized String apostar(int apuesta) {
        String respuesta = "";
        if (noactiva) {
            respuesta = "partida no activa. No se puede apostar. haz post en acertarnumero/api"; // No se puede apostar si la partida no está activa
        } else if (apuesta < minimo || apuesta > maximo) {
            respuesta = "el número no está entre el mínimo y el máximo"; // La apuesta debe estar dentro del rango permitido
        } else if (apuesta == secreto) {
            respuesta = "bravo! acertaste el secreto: " + secreto; // El jugador acertó el número secreto
            noactiva = true; // Marca la partida como no activa
        } else if (secreto < apuesta) {
            respuesta = "secreto es menor que " + apuesta; // El número secreto es menor que la apuesta
        } else if (secreto > apuesta) {
            respuesta = "secreto es mayor que " + apuesta; // El número secreto es mayor que la apuesta
        }
        if (historialApuestas == null) {
            historialApuestas = new ArrayList<>();  // Inicializar la lista si está null
        }
        historialApuestas.add(new Apuesta(apuesta, respuesta));
        return respuesta; // Devuelve el resultado de la apuesta
    }

    /**
     * Obtiene el valor mínimo para el rango de apuestas.
     *
     * @return el límite inferior del rango de apuestas
     */
    public Integer getMinimo() {
        return minimo;
    }

    /**
     * Obtiene el valor máximo para el rango de apuestas.
     *
     * @return el límite superior del rango de apuestas
     */
    public Integer getMaximo() {
        return maximo;
    }

    /**
     * Indica si la partida está activa o no.
     *
     * @return true si la partida no está activa, false si está activa
     */
    public boolean isNoactiva() {
        return noactiva;
    }

    public List<Apuesta> getHistorialApuestas() {
        return historialApuestas;
    }
}
