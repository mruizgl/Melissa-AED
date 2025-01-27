package es.iespuertodelacruz.mr.institutov2.services;

import java.util.List;

public interface IServiceGeneric<T, E> {
	List<T> findAll();
	T findById(E id);
	T save(T t);
	boolean delete(E id);
	boolean update(T t);
}
