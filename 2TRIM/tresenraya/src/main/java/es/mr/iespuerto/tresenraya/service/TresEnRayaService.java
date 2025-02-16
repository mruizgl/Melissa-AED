package es.mr.iespuerto.tresenraya.service;


import es.mr.iespuerto.tresenraya.dto.ApuestaDTO;
import es.mr.iespuerto.tresenraya.model.Estado;
import es.mr.iespuerto.tresenraya.model.TresEnRaya;
import es.mr.iespuerto.tresenraya.repository.TresEnRayaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class TresEnRayaService {
    private final TresEnRayaRepository repository;

    @Autowired
    public TresEnRayaService(TresEnRayaRepository repository) {
        this.repository = repository;
    }

    public TresEnRaya crearPartida(String nickJug1, char simboloJug1, char simboloJug2) {
        TresEnRaya partida = new TresEnRaya();
        partida.setNickJug1(nickJug1);
        partida.setSimboloJug1(simboloJug1);
        partida.setSimboloJug2(simboloJug2);
        return repository.save(partida);
    }

    public Optional<TresEnRaya> obtenerPartida(Long id) {
        return repository.findById(id);
    }

    public TresEnRaya realizarApuesta(Long id, ApuestaDTO apuesta, String jugador) {
        TresEnRaya partida = repository.findById(id)
                .orElseThrow(() -> new IllegalArgumentException("Partida no encontrada"));

        if (partida.getEstado() == Estado.FINALIZADA) {
            throw new IllegalStateException("La partida ya ha finalizado");
        }

        char[][] escenario = partida.getEscenario();
        if (escenario[apuesta.getFila()][apuesta.getColumna()] != '-') {
            throw new IllegalArgumentException("La casilla ya está ocupada");
        }

        char simbolo = jugador.equals(partida.getNickJug1()) ? partida.getSimboloJug1() : partida.getSimboloJug2();
        partida.actualizarEscenario(apuesta.getFila(), apuesta.getColumna(), simbolo);

        return repository.save(partida);
    }

    public Iterable<TresEnRaya> obtenerTodasLasPartidas() {
        return repository.findAll();
    }
}