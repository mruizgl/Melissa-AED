package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;

import es.ies.puerto.mr.tresenraya.domain.model.Game;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IGameRepository;
import es.ies.puerto.mr.tresenraya.mapper.GameMapper;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class GameEntityService implements IGameRepository {
    private final GameJpaRepository gameJpaRepository;

    public GameEntityService(GameJpaRepository gameJpaRepository) {
        this.gameJpaRepository = gameJpaRepository;
    }

    @Override
    public Game save(Game game) {
        GameEntity gameEntity = GameMapper.toEntity(game);
        return GameMapper.toDomain(gameJpaRepository.save(gameEntity));
    }

    @Override
    public void update(Game game) {
        GameEntity gameEntity = GameMapper.toEntity(game);
        gameJpaRepository.save(gameEntity);
    }

    @Override
    public Optional<Game> findById(Long gameId) {
        return gameJpaRepository.findById(gameId).map(GameMapper::toDomain);
    }
}