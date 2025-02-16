package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IUserRepository;
import es.ies.puerto.mr.tresenraya.mapper.UserMapper;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface UserJpaRepository extends JpaRepository<UserEntity, Long> {

    Optional<UserEntity> findByEmail(String email);

    default Optional<User> findUserByEmail(String email) {
        return findByEmail(email).map(UserMapper::toDomain);
    }

    default User saveUser(User user) {
        UserEntity userEntity = UserMapper.toEntity(user);
        UserEntity savedEntity = save(userEntity);
        return UserMapper.toDomain(savedEntity);
    }
}




