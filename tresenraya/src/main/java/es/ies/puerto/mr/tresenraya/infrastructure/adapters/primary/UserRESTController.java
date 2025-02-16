package es.ies.puerto.mr.tresenraya.infrastructure.adapters.primary;

import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.primary.IUserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/users")
public class UserRESTController {
    private static final Logger logger = LoggerFactory.getLogger(UserRESTController.class);
    private final IUserService userService;

    public UserRESTController(IUserService userService) {
        this.userService = userService;
    }

    @PostMapping("/register")
    public ResponseEntity<?> registerUser(@RequestBody UserDTO userDTO) {
        logger.info("Intentando registrar usuario con email: {}", userDTO.getEmail());
        try {
            User user = userService.registerUser(userDTO.getEmail(), userDTO.getUsername(), userDTO.getPassword());
            logger.info("Usuario registrado correctamente: {}", user.getEmail());
            return ResponseEntity.ok(user);
        } catch (IllegalArgumentException e) {
            logger.warn("Error en el registro: {}", e.getMessage());
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }

    @PostMapping("/login")
    public ResponseEntity<User> loginUser(@RequestBody UserDTO userDTO) {
        logger.info("Intentando iniciar sesión con email: {}", userDTO.getEmail());
        Optional<User> user = userService.authenticateUser(userDTO.getEmail(), userDTO.getPassword());

        if (user.isPresent()) {
            logger.info("Inicio de sesión exitoso para: {}", userDTO.getEmail());
            return ResponseEntity.ok(user.get());
        } else {
            logger.warn("Fallo en inicio de sesión para: {}", userDTO.getEmail());
            return ResponseEntity.status(401).build();
        }
    }
}