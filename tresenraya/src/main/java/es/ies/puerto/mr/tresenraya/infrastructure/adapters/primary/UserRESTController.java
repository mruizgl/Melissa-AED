package es.ies.puerto.mr.tresenraya.infrastructure.adapters.primary;

import es.ies.puerto.mr.tresenraya.domain.model.User;
import es.ies.puerto.mr.tresenraya.domain.ports.primary.IUserService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("/users")
public class UserRESTController {
    private final IUserService userService;

    public UserRESTController(IUserService userService) {
        this.userService = userService;
    }

    @PostMapping("/register")
    public ResponseEntity<?> registerUser(@RequestBody UserDTO userDTO) {
        try {
            User user = userService.registerUser(userDTO.getEmail(), userDTO.getUsername(), userDTO.getPassword());
            return ResponseEntity.ok(user);
        } catch (IllegalArgumentException e) {
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }

    @PostMapping("/login")
    public ResponseEntity<User> loginUser(@RequestBody UserDTO userDTO) {
        Optional<User> user = userService.authenticateUser(userDTO.getEmail(), userDTO.getPassword());
        return user.map(ResponseEntity::ok)
                .orElseGet(() -> ResponseEntity.status(401).build());
    }
}