package es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class UserEntityService {
    private final UserJpaRepository userEntityRepository;
    private final PasswordEncoder passwordEncoder;

    public UserEntityService(UserJpaRepository userEntityRepository, PasswordEncoder passwordEncoder) {
        this.userEntityRepository = userEntityRepository;
        this.passwordEncoder = passwordEncoder;
    }

    public UserEntity registerUser(String email, String username, String password) {
        if (userEntityRepository.findByEmail(email).isPresent()) {
            throw new IllegalArgumentException("El email ya está registrado");
        }

        UserEntity newUser = new UserEntity(null, email, passwordEncoder.encode(password), username);
        return userEntityRepository.save(newUser);
    }

    public Optional<UserEntity> authenticateUser(String email, String password) {
        return userEntityRepository.findByEmail(email)
                .filter(user -> passwordEncoder.matches(password, user.getPassword()))
                .map(user -> new UserEntity(user.getId(), user.getEmail(), user.getPassword(), user.getUsername()));
    }
}

