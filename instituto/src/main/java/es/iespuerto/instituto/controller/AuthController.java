package es.iespuerto.instituto.controller;

import es.iespuerto.instituto.repository.IUsuarioRepository;
import es.iespuerto.instituto.security.AuthService;
import es.iespuerto.instituto.service.MailService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping
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
    public ResponseEntity<String> login(@RequestBody UsuarioLogin u) {
        String token = authService.authenticate(u.getNombre(), u.getPassword());
        if (token == null) {
            throw new RuntimeException("Credenciales inválidas");
        }
        return ResponseEntity.ok(token);
    }

    static class UsuarioRegister {
        public UsuarioRegister() {}
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
    }

    @PostMapping("/register")
    public String register(@RequestBody UsuarioRegister u) {
        String token = authService.register(u.getNombre(), u.getPassword(), u.getCorreo());
        String[] senders = {u.getCorreo()};
        mailService.send(senders, "usuario creado", token);
        return token;
    }
}