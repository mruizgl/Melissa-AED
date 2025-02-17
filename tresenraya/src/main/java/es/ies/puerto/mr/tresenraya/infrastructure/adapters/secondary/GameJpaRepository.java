package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface GameJpaRepository extends JpaRepository<GameEntity, Long> {
}
