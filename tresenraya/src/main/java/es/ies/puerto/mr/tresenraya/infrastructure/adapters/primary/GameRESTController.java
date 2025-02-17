package es.ies.puerto.mr.tresenraya.infrastructure.adapters.primary;

import es.ies.puerto.mr.tresenraya.domain.model.Game;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.primary.IGameService;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IUserRepository;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/games")
public class GameRESTController {
    private final IGameService gameService;
    private final IUserRepository userRepository; // Se necesita para obtener usuarios

    public GameRESTController(IGameService gameService, IUserRepository userRepository) {
        this.gameService = gameService;
        this.userRepository = userRepository;
    }

    @PostMapping("/new")
    public ResponseEntity<Game> createGame(@RequestParam Long player1Id) {
        Optional<User> player1 = userRepository.findById(player1Id);
        if (player1.isEmpty()) {
            return ResponseEntity.badRequest().build();
        }
        Game game = gameService.createGame(player1.get());
        return ResponseEntity.ok(game);
    }

    @PostMapping("/{id}/join")
    public ResponseEntity<Game> joinGame(@PathVariable Long id, @RequestParam Long player2Id) {
        Optional<User> player2 = userRepository.findById(player2Id);
        if (player2.isEmpty()) {
            return ResponseEntity.badRequest().build();
        }
        Optional<Game> game = gameService.joinGame(id, player2.get());
        return game.map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.notFound().build());
    }

    @PostMapping("/{id}/move")
    public ResponseEntity<Game> makeMove(@PathVariable Long id, @RequestParam int row, @RequestParam int col, @RequestParam Long playerId) {
        Optional<User> player = userRepository.findById(playerId);
        if (player.isEmpty()) {
            return ResponseEntity.badRequest().build();
        }
        String symbol = (player.get().equals(gameService.getGameStatus(id).get().getPlayer1())) ? "X" : "O";
        Optional<Game> game = gameService.makeMove(id, row, col, symbol);
        return game.map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.badRequest().build());
    }

    @GetMapping("/{id}")
    public ResponseEntity<Game> getGameState(@PathVariable Long id) {
        Optional<Game> game = gameService.getGameStatus(id);
        return game.map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.notFound().build());
    }

    @GetMapping("/{id}/spectate")
    public ResponseEntity<Game> spectateGame(@PathVariable Long id) {
        Optional<Game> game = gameService.spectateGame(id);
        return game.map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.notFound().build());
    }

    @GetMapping("/last-id")
    public ResponseEntity<Long> getLastGameId() {
        Long lastId = gameService.getLastGameId();
        return ResponseEntity.ok(lastId);
    }

    @GetMapping("/available")
    public ResponseEntity<Game> findAvailableGame() {
        Optional<Game> availableGame = gameService.findAvailableGame();
        return availableGame.map(ResponseEntity::ok).orElseGet(() -> ResponseEntity.noContent().build());
    }

}
