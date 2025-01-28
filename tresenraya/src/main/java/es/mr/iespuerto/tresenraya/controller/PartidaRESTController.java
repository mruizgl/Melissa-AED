package es.mr.iespuerto.tresenraya.controller;

import es.mr.iespuerto.tresenraya.dto.ApuestaDTO;
import es.mr.iespuerto.tresenraya.model.TresEnRaya;
import es.mr.iespuerto.tresenraya.service.TresEnRayaService;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/partidas")
public class PartidaRESTController {
    private final TresEnRayaService service;

    public PartidaRESTController(TresEnRayaService service) {
        this.service = service;
    }

    @PostMapping
    public TresEnRaya crearPartida(@RequestParam String nickJug1, @RequestParam char simboloJug1, @RequestParam char simboloJug2) {
        return service.crearPartida(nickJug1, simboloJug1, simboloJug2);
    }

    @GetMapping("/{id}")
    public TresEnRaya obtenerPartida(@PathVariable Long id) {
        return service.obtenerPartida(id)
                .orElseThrow(() -> new IllegalArgumentException("Partida no encontrada"));
    }

    @PostMapping("/{id}/apuestas")
    public TresEnRaya realizarApuesta(@PathVariable Long id, @RequestBody ApuestaDTO apuesta, @RequestParam String jugador) {
        return service.realizarApuesta(id, apuesta, jugador);
    }

    @GetMapping
    public List<TresEnRaya> obtenerTodasLasPartidas() {
        return (List<TresEnRaya>) service.obtenerTodasLasPartidas();
    }
}