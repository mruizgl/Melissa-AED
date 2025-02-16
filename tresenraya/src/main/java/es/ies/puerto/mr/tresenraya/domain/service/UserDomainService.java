package es.ies.puerto.mr.tresenraya.domain.service;
import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.primary.IUserService;
import es.ies.puerto.mr.tresenraya.domain.ports.secondary.IUserRepository;
import es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary.UserEntity;
import es.ies.puerto.mr.tresenraya.infrastructure.adapters.secondary.UserJpaRepository;
import es.ies.puerto.mr.tresenraya.mapper.UserMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
public class UserDomainService implements IUserService {

    @Autowired
    private UserJpaRepository repository;

    @Autowired
    private PasswordEncoder passwordEncoder;

    @Override
    public User registerUser(String email, String username, String password) {
        if (repository.findUserByEmail(email).isPresent()) {
            throw new IllegalArgumentException("El email ya está registrado");
        }

        User newUser = new User(null, email, passwordEncoder.encode(password), username);
        return repository.saveUser(newUser);
    }

    @Override
    public Optional<User> authenticateUser(String email, String password) {
        return repository.findUserByEmail(email)
                .filter(user -> passwordEncoder.matches(password, user.getPassword()));
    }
}

