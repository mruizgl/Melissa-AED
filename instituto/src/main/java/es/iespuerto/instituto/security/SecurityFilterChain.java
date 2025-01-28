package es.iespuerto.instituto.security;



//@Configuration
//@EnableWebSecurity
public class SecurityFilterChain {
    /**
     *
     * @param http
     * @return
     * @throws Exception

    @Bean
    public org.springframework.security.web.SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {

        http
        .authorizeHttpRequests(authorizeRequests ->
                authorizeRequests
                        //.requestMatchers("/instituto/api/v1/alumnos").authenticated()
                        .anyRequest().permitAll()


        );

        return http.build();
    } */
}