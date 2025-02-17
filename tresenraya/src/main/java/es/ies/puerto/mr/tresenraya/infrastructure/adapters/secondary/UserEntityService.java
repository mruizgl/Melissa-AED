package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IUserRepository;
import es.ies.puerto.mr.tresenraya.mapper.UserMapper;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class UserEntityService implements IUserRepository {
    private final UserJpaRepository userEntityRepository;
    private final PasswordEncoder passwordEncoder;

    public UserEntityService(UserJpaRepository userEntityRepository, PasswordEncoder passwordEncoder) {
        this.userEntityRepository = userEntityRepository;
        this.passwordEncoder = passwordEncoder;
    }

    @Override
    public Optional<User> findByEmail(String email) {
        return userEntityRepository.findByEmail(email).map(UserMapper::toDomain);
    }

    @Override
    public User save(User user) {
        // Encriptar la contraseña antes de guardar
        user.setPassword(passwordEncoder.encode(user.getPassword()));
        return UserMapper.toDomain(userEntityRepository.save(UserMapper.toEntity(user)));
    }

    @Override
    public Optional<User> findById(Long id) {
        return userEntityRepository.findById(id).map(UserMapper::toDomain);
    }
}

