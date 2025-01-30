package es.iespuerto.instituto.security;

import es.iespuerto.instituto.controller.AlumnoRESTController;
import es.iespuerto.instituto.repository.IUsuarioRepository;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import es.iespuerto.instituto.entities.Usuario;
import org.springframework.transaction.annotation.Transactional;

import java.util.Date;
import java.util.Optional;
import java.util.UUID;


@Service
public class AuthService {
	private static final Logger logger = LoggerFactory.getLogger(AlumnoRESTController.class);
	@Autowired
	private IUsuarioRepository usuarioRepository;
	@Autowired
	private JwtService jwtService;
	@Autowired
	private PasswordEncoder passwordEncoder;

	@Transactional
	public Usuario register(String dni, String nombre, String password, String correo) {
		logger.info("Ejecutando AuthService.register con DNI: {}", dni);

		Optional<Usuario> existingUsuario = Optional.ofNullable(usuarioRepository.findUsuarioByDNI(dni));
		if (existingUsuario.isPresent()) {
			logger.warn("El usuario ya existe con DNI: {}", dni);
			throw new IllegalArgumentException("El usuario con este DNI ya existe");
		}

		Usuario usuario = new Usuario();
		usuario.setDni(dni);
		usuario.setNombre(nombre);
		usuario.setPassword(passwordEncoder.encode(password));
		usuario.setFechaCreacion(System.currentTimeMillis());
		usuario.setCorreo(correo);
		usuario.setRol("ROLE_USER");
		usuario.setVerificado(0);
		usuario.setRememberToken(UUID.randomUUID().toString());

		Usuario saved = usuarioRepository.save(usuario);
		logger.info("Usuario guardado con DNI: {}", saved.getDni());

		return saved;
	}

	public String authenticate(String nombre, String password) {
		String generateToken = null;
		Usuario usuario = usuarioRepository.findByNombre(nombre).orElse(null);
		if (usuario != null) {
			if (passwordEncoder.matches(password, usuario.getPassword())) {
				generateToken = jwtService.generateToken(usuario.getNombre(), usuario.getRol());
			}
		}
		return generateToken;
	}

	public boolean confirmEmail(String correo, String token) {
		Usuario usuario = usuarioRepository.findByCorreo(correo);
		if (usuario != null && usuario.getRememberToken().equals(token)) {
			usuario.setVerificado(1);
			usuarioRepository.save(usuario);
			return true;
		}
		return false;
	}
}

