package es.ies.puerto.mr.tresenraya.domain.ports.secondary;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary.UserEntity;

import java.util.Optional;


public interface IUserRepository {
    Optional<User> findByEmail(String email);
    User save(User user);
    Optional<User> findById(Long id);
}


