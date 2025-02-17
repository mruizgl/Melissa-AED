package es.ies.puerto.mr.tresenraya.mapper;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import es.ies.puerto.mr.tresenraya.domain.model.Game;
import es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary.GameEntity;

public class GameMapper {
    private static final ObjectMapper objectMapper = new ObjectMapper();

    public static GameEntity toEntity(Game game) {
        return new GameEntity(
                game.getId(),
                UserMapper.toEntity(game.getPlayer1()),
                game.getPlayer2() != null ? UserMapper.toEntity(game.getPlayer2()) : null,
                game.getStatus(),
                serializeBoardState(game.getBoardState())
        );
    }

    public static Game toDomain(GameEntity entity) {
        return new Game(
                entity.getId(),
                UserMapper.toDomain(entity.getPlayer1()),
                entity.getPlayer2() != null ? UserMapper.toDomain(entity.getPlayer2()) : null,
                entity.getStatus(),
                deserializeBoardState(entity.getBoardState())
        );
    }

    private static String serializeBoardState(String[][] boardState) {
        try {
            return objectMapper.writeValueAsString(boardState);
        } catch (JsonProcessingException e) {
            throw new RuntimeException("Error serializando el estado del tablero", e);
        }
    }

    private static String[][] deserializeBoardState(String boardState) {
        try {
            return objectMapper.readValue(boardState, String[][].class);
        } catch (JsonProcessingException e) {
            throw new RuntimeException("Error deserializando el estado del tablero", e);
        }
    }
}

