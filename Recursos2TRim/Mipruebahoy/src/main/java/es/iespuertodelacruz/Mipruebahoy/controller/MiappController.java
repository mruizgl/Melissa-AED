package es.iespuertodelacruz.Mipruebahoy.controller;

import es.iespuertodelacruz.Mipruebahoy.domain.AcertarNumero;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("acertarnumero/api")
@CrossOrigin
public class MiappController {

    public static class ApuestaDTO {
        int apuesta;
        public int getApuesta() {
            return apuesta;
        }
        public void setApuesta(int apuesta) {
            this.apuesta = apuesta;
        }
        public ApuestaDTO() {}

    }

    @PostMapping("/apuestas")
    public ResponseEntity<?> apostar(@RequestBody ApuestaDTO apuestaDTO) {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        String mensaje = acertarNumero.apostar(apuestaDTO.getApuesta());
        return ResponseEntity.ok(mensaje);
    }

    @PostMapping
    public ResponseEntity<?> reiniciar(){
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        boolean ok = acertarNumero.iniciarReiniciarPartida();
        if (!ok) {
            return ResponseEntity.badRequest().body("la partida tiene que acertarse el secreto antes de reiniciar");
        } else {
            return ResponseEntity.ok("reiniciada correctamente. nuevo secreto entre: " + acertarNumero.getMinimo()+" y " +acertarNumero.getMaximo());
        }
    }

    @GetMapping
    public ResponseEntity<?> status() {
        AcertarNumero acertarNumero = AcertarNumero.getInstance();
        String mensaje = "";
        if(acertarNumero.isNoactiva()) {
            mensaje = "estado no activo hay que generar un secreto POST /acertarnumero/api";

        }else {
            mensaje = "estado activo con secreto entre los numeros: " + acertarNumero.getMinimo() + " y " + acertarNumero.getMaximo();
        }
        return ResponseEntity.ok(mensaje);
    }


}
