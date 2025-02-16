package es.ies.puerto.mr.tresenraya.domain.ports.primary;

import es.ies.puerto.mr.tresenraya.domain.model.User;

import java.util.Optional;

public interface IUserService {
    User registerUser(String email, String username, String password);
    Optional<User> authenticateUser(String email, String password);
}