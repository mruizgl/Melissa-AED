package es.ies.puerto.mr.tresenraya.domain.service;

import es.ies.puerto.mr.tresenraya.domain.model.Game;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.primary.IGameService;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IGameRepository;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IUserRepository;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class GameDomainService implements IGameService {
    private final IGameRepository gameRepository;
    private final IUserRepository userRepository;

    public GameDomainService(IGameRepository gameRepository, IUserRepository userRepository) {
        this.gameRepository = gameRepository;
        this.userRepository = userRepository;
    }

    @Override
    public Game createGame(User player1) {
        Game game = new Game(null, player1, null, "IN_PROGRESS", new String[3][3]);
        return gameRepository.save(game);
    }

    @Override
    public Optional<Game> joinGame(Long gameId, User player2) {
        Optional<Game> gameOptional = gameRepository.findById(gameId);
        if (gameOptional.isPresent()) {
            Game game = gameOptional.get();
            if (game.getPlayer2() == null) {
                game.setPlayer2(player2);
                return Optional.of(gameRepository.save(game));
            }
        }
        return Optional.empty();
    }

    @Override
    public Optional<Game> makeMove(Long gameId, int row, int col, String symbol) {
        Optional<Game> gameOptional = gameRepository.findById(gameId);
        if (gameOptional.isPresent()) {
            Game game = gameOptional.get();
            if (game.getBoardState()[row][col] == null) {
                game.getBoardState()[row][col] = symbol;
                return Optional.of(gameRepository.save(game));
            }
        }
        return Optional.empty();
    }

    @Override
    public Optional<Game> getGameStatus(Long gameId) {
        return gameRepository.findById(gameId);
    }

    @Override
    public Optional<Game> spectateGame(Long gameId) {
        return gameRepository.findById(gameId);
    }
}