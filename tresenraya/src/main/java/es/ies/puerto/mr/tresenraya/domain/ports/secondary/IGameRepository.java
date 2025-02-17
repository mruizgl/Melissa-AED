package es.ies.puerto.mr.tresenraya.domain.ports.secondary;

import es.ies.puerto.mr.tresenraya.domain.model.Game;

import java.util.Optional;

public interface IGameRepository {
    Optional<Game> findById(Long id);
    Game save(Game game);
    void update(Game game);
    Optional<Game> findFirstByOrderByIdDesc();
    Optional<Game> findFirstByPlayer2IsNull();

}