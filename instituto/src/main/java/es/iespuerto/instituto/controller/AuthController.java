package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.entities.Usuario;
import es.iespuerto.instituto.repository.IUsuarioRepository;
import es.iespuerto.instituto.security.AuthService;
import es.iespuerto.instituto.service.MailService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/auth/")
@CrossOrigin
public class AuthController {
    @Autowired
    private IUsuarioRepository usuarioRepository;

    @Autowired
    private MailService mailService;
    @Autowired
    private AuthService authService;

    static class UsuarioLogin {
        public UsuarioLogin() {}
        public String nombre;
        public String password;
        public String getPassword() {
            return password;
        }
        public void setPassword(String password) {
            this.password = password;
        }
        public String getNombre() {
            return nombre;
        }
        public void setNombre(String nombre) {
            this.nombre = nombre;
        }
    }

    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody UsuarioLogin u) {
        try {
            String token = authService.authenticate(u.getNombre(), u.getPassword());
            if (token == null) {
                return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body("Credenciales inválidas");
            }
            return ResponseEntity.ok(token);
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error en autenticación: " + e.getMessage());
        }
    }

    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody UsuarioRegister u) {
        try {
            Usuario registered = authService.register(u.getDni(), u.getNombre(), u.getPassword(), u.getCorreo());
            String confirmUri = "http://localhost:8080/auth/confirmation?correo=" + registered.getCorreo() + "&token=" + registered.getRememberToken();
            mailService.send(new String[]{u.getCorreo()}, "usuario creado", confirmUri);
            return ResponseEntity.ok("Correo de verificación enviado");
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error en registro: " + e.getMessage());
        }
    }

    static class UsuarioRegister {
        public UsuarioRegister() {}
        public String dni;
        public String nombre;
        public String password;
        public String correo;
        public String getPassword() {
            return password;
        }
        public void setPassword(String password) {
            this.password = password;
        }
        public String getNombre() {
            return nombre;
        }
        public void setNombre(String nombre) {
            this.nombre = nombre;
        }
        public String getCorreo() {
            return correo;
        }
        public void setCorreo(String correo) {
            this.correo = correo;
        }

        public String getDni() {
            return dni;
        }
    }



    /**
     *
     * @return

    @GetMapping("/confirmation")
    public String confirmation() {

    }   */
}