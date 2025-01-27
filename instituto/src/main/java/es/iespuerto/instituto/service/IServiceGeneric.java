package es.iespuerto.instituto.service;

import java.util.List;

public interface IServiceGeneric<T, E> {
    List<T> findAll();
    T findById(E id);
    T save(T t);
    boolean delete(E id);
    boolean update(T t);
}
