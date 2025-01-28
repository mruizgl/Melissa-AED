package es.iespuerto.instituto.service;

import java.util.List;

/**
 * Interfaz genérica para los servicios
 * @param <T> Entidad
 * @param <E> Id
 */
public interface IServiceGeneric<T, E> {
    List<T> findAll();
    T findById(E id);
    T save(T t);
    boolean delete(E id);
    boolean update(T t);
}
