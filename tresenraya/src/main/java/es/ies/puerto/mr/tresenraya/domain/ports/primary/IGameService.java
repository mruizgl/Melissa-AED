package es.ies.puerto.mr.tresenraya.domain.ports.primary;

import es.ies.puerto.mr.tresenraya.domain.model.Game;
import es.ies.puerto.mr.tresenraya.domain.model.User;

import java.util.Optional;

public interface IGameService {
    Game createGame(User player1);
    Optional<Game> joinGame(Long gameId, User player2);
    Optional<Game> makeMove(Long gameId, int row, int col, String symbol);
    Optional<Game> getGameStatus(Long gameId);
    Optional<Game> spectateGame(Long gameId);
}