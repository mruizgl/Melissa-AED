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
    public Long getLastGameId() {
        return gameRepository.findFirstByOrderByIdDesc()
                .map(Game::getId)
                .orElse(0L);
    }

    @Override
    public Game createGame(User player1) {
        Game game = new Game(null, player1, null, "WAITING", new String[3][3]);
        return gameRepository.save(game);
    }

    @Override
    public Optional<Game> joinGame(Long gameId, User player2) {
        Optional<Game> gameOptional = gameRepository.findById(gameId);

        if (gameOptional.isPresent()) {
            Game game = gameOptional.get();

            if (game.getPlayer2() == null) {
                game.setPlayer2(player2);
                game.setStatus("IN_PROGRESS");
                return Optional.of(gameRepository.save(game));
            }
        }
        return Optional.empty();
    }


    private boolean checkWinner(String[][] board, String symbol) {
        for (int i = 0; i < 3; i++) {
            // 🔹 Filas y columnas
            if (symbol.equals(board[i][0]) && symbol.equals(board[i][1]) && symbol.equals(board[i][2])) return true;
            if (symbol.equals(board[0][i]) && symbol.equals(board[1][i]) && symbol.equals(board[2][i])) return true;
        }
        // 🔹 Diagonales
        if (symbol.equals(board[0][0]) && symbol.equals(board[1][1]) && symbol.equals(board[2][2])) return true;
        if (symbol.equals(board[0][2]) && symbol.equals(board[1][1]) && symbol.equals(board[2][0])) return true;

        return false;
    }

    private boolean isBoardFull(String[][] board) {
        for (String[] row : board) {
            for (String cell : row) {
                if (cell == null) return false;
            }
        }
        return true;
    }




    @Override
    public Optional<Game> makeMove(Long gameId, int row, int col, String symbol) {
        Optional<Game> gameOptional = gameRepository.findById(gameId);

        if (gameOptional.isPresent()) {
            Game game = gameOptional.get();

            if (game.getWinner() != null || "FINISHED".equals(game.getStatus())) {
                return Optional.empty();
            }

            if (game.getBoardState()[row][col] == null) {
                game.getBoardState()[row][col] = symbol;

                if (checkWinner(game.getBoardState(), symbol)) {
                    if (symbol.equals("X")) {
                        game.setWinner(game.getPlayer1());
                    } else {
                        game.setWinner(game.getPlayer2());
                    }
                    game.setStatus("FINISHED");
                } else if (isBoardFull(game.getBoardState())) {
                    game.setStatus("FINISHED");
                }

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
    @Override
    public Optional<Game> findAvailableGame() {
        return gameRepository.findFirstByPlayer2IsNull();
    }

}