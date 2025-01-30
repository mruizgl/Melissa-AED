package es.iespuerto.instituto.security;

import es.iespuerto.instituto.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import es.iespuerto.instituto.entities.Usuario;
import org.springframework.transaction.annotation.Transactional;

import java.sql.Time;
import java.util.Date;
import java.util.UUID;


@Service
public class AuthService {
	@Autowired
	private IUsuarioRepository usuarioRepository;
	@Autowired
	private JwtService jwtService;
	@Autowired
	private PasswordEncoder passwordEncoder;

	@Transactional
	public Usuario register(String dni, String username, String password, String correo) {

		if (usuarioRepository.findUsuarioByDNI(dni) > 0) {
			throw new IllegalArgumentException("El usuario con este DNI ya existe");
		}
		Usuario usuario = new Usuario();
		usuario.setDni(dni);
		usuario.setNombre(username);
		usuario.setPassword(passwordEncoder.encode(password));
		usuario.setFechaCreacion(new Date().getTime());
		usuario.setEmail(correo);
		usuario.setRol("ROLE_USER");
		usuario.setVerificado(0);
		usuario.setRememberToken(UUID.randomUUID().toString());
		Usuario saved = usuarioRepository.save(usuario);
		if( saved != null) {
			return saved;
		}else {
			return null;
		}
	}






	public String authenticate(String nombre, String password) {
		String generateToken = null;
		Usuario usuario = usuarioRepository.findByNombre(nombre).orElse(null);
		if (usuario != null) {
			if (passwordEncoder.matches(password, usuario.getPassword())) {
				generateToken = jwtService.generateToken(usuario.getNombre(),
						usuario.getRol());
			}
		}
		return generateToken;
	}
}

