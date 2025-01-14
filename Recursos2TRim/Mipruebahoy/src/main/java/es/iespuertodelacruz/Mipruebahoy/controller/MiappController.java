package es.iespuertodelacruz.Mipruebahoy.controller;

import es.iespuertodelacruz.Mipruebahoy.domain.AcertarNumero;
import es.iespuertodelacruz.Mipruebahoy.domain.Apuesta;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

/**
 * Controlador principal de la API para gestionar el juego "Acertar Número".
 * Proporciona endpoints para realizar apuestas, reiniciar la partida,
 * consultar el estado actual y comenzar una nueva partida.
 *
 * @author Melissa Ruiz
 */
@RestController
@RequestMapping("acertarnumero/api")
@CrossOrigin
public class MiappController {

    /**
     * DTO (Data Transfer Object) para manejar los datos de una apuesta.
     */
    public static class ApuestaDTO {
        int apuesta;

        /**
         * Obtiene el número de la apuesta.
         *
         * @return el número apostado
         */
        public int getApuesta() {
            return apuesta;
        }

        /**
         * Establece el número de la apuesta.
         *
         * @param apuesta el número que se desea apostar
         */
        public void setApuesta(int apuesta) {
            this.apuesta = apuesta;
        }

        /**
         * Constructor por defecto del DTO de apuesta.
         */
        public ApuestaDTO() {}
    }

    /**
     * Endpoint para realizar una apuesta en el juego.
     *
     * @param apuestaDTO contiene el número de la apuesta realizada por el usuario
     * @return una respuesta HTTP con el mensaje correspondiente al resultado de la apuesta
     */
    @PostMapping("/apuestas")
    public ResponseEntity<?> apostar(@RequestBody ApuestaDTO apuestaDTO) {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        String mensaje = acertarNumero.apostar(apuestaDTO.getApuesta());
        return ResponseEntity.ok(mensaje);
    }

    /**
     * Endpoint para reiniciar la partida del juego.
     *
     * @return una respuesta HTTP indicando si la partida se reinició correctamente
     *         o si hay un error porque la partida no se ha completado aún
     */
    @PostMapping
    public ResponseEntity<?> reiniciar() {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        boolean ok = acertarNumero.iniciarReiniciarPartida();
        if (!ok) {
            return ResponseEntity.badRequest().body("la partida tiene que acertarse el secreto antes de reiniciar");
        } else {
            return ResponseEntity.ok("reiniciada correctamente. nuevo secreto entre: " + acertarNumero.getMinimo() + " y " + acertarNumero.getMaximo());
        }
    }

    /**
     * Endpoint para consultar el estado actual del juego.
     *
     * @return una respuesta HTTP con información sobre si el juego está activo y
     *         el rango del número secreto
     */
    @GetMapping
    public ResponseEntity<?> status() {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        String mensaje = "";
        if (acertarNumero.isNoactiva()) {
            mensaje = "estado no activo hay que generar un secreto POST /acertarnumero/api";
        } else {
            mensaje = "estado activo con secreto entre los numeros: " + acertarNumero.getMinimo() + " y " + acertarNumero.getMaximo();
        }
        return ResponseEntity.ok(mensaje);
    }

    /**
     * Endpoint para iniciar una nueva partida en el juego.
     *
     * @return una respuesta HTTP indicando que la partida se ha iniciado
     */
    @PostMapping("/iniciar")
    public ResponseEntity<String> iniciarPartida() {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        acertarNumero.iniciarReiniciarPartida();
        return ResponseEntity.ok("Partida iniciada");
    }

    @GetMapping("/historial")
    public ResponseEntity<List<Apuesta>> obtenerHistorial() {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        List<Apuesta> historial = acertarNumero.getHistorialApuestas();
        return ResponseEntity.ok(historial);
    }
}
