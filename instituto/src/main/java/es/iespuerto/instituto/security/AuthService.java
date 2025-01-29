package es.iespuerto.instituto.security;

import es.iespuerto.instituto.repository.IUsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import es.iespuerto.instituto.entities.Usuario;





@Service
public class AuthService {
	@Autowired
	private IUsuarioRepository usuarioRepository;
	@Autowired
	private JwtService jwtService;
	@Autowired
	private PasswordEncoder passwordEncoder;

	public String register(String username, String password, String email) {
		Usuario usuario = new Usuario();
		usuario.setNombre(username);
		usuario.setPassword(passwordEncoder.encode(password));
		usuario.setEmail(email);
		usuario.setRol("ROLE_USER");
		Usuario saved = usuarioRepository.save(usuario);
		if( saved != null) {
			String generateToken = jwtService.generateToken(usuario.getNombre(),
					usuario.getRol());
			return generateToken;
		}else {
			return null;
		}
	}



	public String register(String username, String password) {
		Usuario usuario = new Usuario();
		usuario.setNombre(username);
		usuario.setPassword(passwordEncoder.encode(password));
		usuario.setRol("ROLE_USER");
		Usuario saved = usuarioRepository.save(usuario);
		if( saved != null) {
			String generateToken = jwtService.generateToken(usuario.getNombre(),
					usuario.getRol());
			return generateToken;
		}else {
			return null;
		}
	}
	public String authenticate(String username, String password) {
		String generateToken = null;
		Usuario usuario = usuarioRepository.findByNombre(username).orElse(null);
		if (usuario != null) {
			if (passwordEncoder.matches(password, usuario.getPassword())) {
				generateToken = jwtService.generateToken(usuario.getNombre(),
						usuario.getRol());
			}
		}
		return generateToken;
	}
}

