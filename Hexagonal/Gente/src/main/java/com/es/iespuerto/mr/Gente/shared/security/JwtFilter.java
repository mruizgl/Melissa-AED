package com.es.iespuerto.mr.Gente.shared.security;

import jakarta.servlet.FilterChain;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import org.springframework.web.filter.OncePerRequestFilter;

import java.io.IOException;

public class JwtFilter extends OncePerRequestFilter {


    @Override
    protected void doFilterInternal(HttpServletRequest request, HttpServletResponse response, FilterChain filterChain) throws ServletException, IOException {
        String path = request.getRequestURI();

        if(1 == 1) {
            filterChain.doFilter(request, response);
            return;
        }

        String rutasPermitidas[] = {
                "/swagger-ui.html",
                "/swagger-ui/"
        };
    }
}
